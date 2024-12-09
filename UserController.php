<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Tymon\JWTAuth\Facades\JWTAuth;

use Exception;

use App\Models\Salons;
use App\Models\Purchaces;
use App\Models\QrCodes;
use App\Models\Users;
use App\Models\Opinions;

class UserController extends Controller
{
    public function salons()
    {
        $salon = Salons::all();
        return response()->json($salon);
    }

    public function activePurchaces(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        $userId = $request->input('userId');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        Log::info('Received userId: ' . $userId);

        $purchaces = Purchaces::where('user_id', $userId)
            ->where('status', 'active')
            ->get();

        if ($purchaces->isEmpty()) {
            return response()->json(['message' => 'No active purchaces found for this user.'], 404);
        }

        return response()->json($purchaces);
    }

    public function qrCodesPurchaces(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        $user_id = $request->input('userId');
        $purchase_id = $request->input('purchaceId');

        $purchases = QrCodes::where('user_id', $user_id)
            ->where('purchaces_id', $purchase_id)
            ->get();

        if ($purchases->isEmpty()) {
            return response()->json([
                'message' => 'No matching purchases found.',
            ], 404);
        }

        return response()->json($purchases, 200);
    }

    public function historyPurchaces(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        $userId = $request->input('userId');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        Log::info('Received userId: ' . $userId);

        $purchaces = Purchaces::where('user_id', $userId)
            ->where('status', 'history')
            ->get();

        if ($purchaces->isEmpty()) {
            return response()->json(['message' => 'No history purchaces found for this user.'], 404);
        }

        return response()->json($purchaces);
    }

    public function editProfile(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        $userId = $request->input('userId');

        Log::info('Received data:', $request->all());


        $validatedData = $request->validate([
            'nickname' => 'string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'email|unique:users,email,' . $userId,
            'birthday_date' => 'nullable|date',
            'city' => 'nullable|string|max:255',
        ]);

        $user = Users::findOrFail($userId);
        $user->update($validatedData);

        return response()->json(['message' => 'Prawidłowo zaktualizowane dane profilu.', 'userId' => $userId]);
    }

    public function addOpinion(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        $request->merge(['userId' => (int) $request->userId]);

        Log::info('Dane otrzymane w request:', $request->all());

        // Walidacja danych
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
            'icon' => 'required|in:like,unlike', // Sprawdzamy, że 'icon' to 'like' lub 'unlike'
            'appSupport' => 'required|integer|between:1,5', // Liczba gwiazdek (1-5)
            'easyToFind' => 'required|integer|between:1,5', // Liczba gwiazdek (1-5)
            'impressions' => 'required|integer|between:1,5', // Liczba gwiazdek (1-5)
            'options' => 'required|string', // Zaznaczone opcje
        ]);

        // Jeżeli walidacja nie przejdzie
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Tworzymy nową opinię
        $opinion = Opinions::create([
            'user_id' => $request->userId,
            'icon' => $request->icon,
            'app_support' => $request->appSupport,
            'easy_to_find' => $request->easyToFind,
            'impressions' => $request->impressions,
            'options' => $request->options, // Przechowujemy opcje jako string
        ]);

        // Zwracamy odpowiedź po udanym zapisaniu
        return response()->json([
            'status' => 'success',
            'message' => 'Opinion saved successfully',
            'data' => $opinion,
        ], 201);
    }
    public function checkOpinionExists(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        // Sprawdzamy, czy userId zostało przekazane w request
        $userId = $request->input('userId');

        // Upewnij się, że userId jest liczbą i nie jest pusty
        if (is_null($userId) || !is_numeric($userId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid userId.',
            ], 400);
        }

        // Sprawdzamy, czy rekord opinii istnieje w tabeli 'opinions' dla tego user_id
        $opinionExists = Opinions::where('user_id', $userId)->exists();

        // Zwracamy odpowiedź w zależności od wyniku
        if ($opinionExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Opinion for this user exists.',
            ], 400);  // Jeśli opinia już istnieje, zwróć 400
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'No opinion found for this user.',
            ], 200);  // Jeśli opinii nie ma, zwróć 200
        }
    }

    public function userOpinion(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        // Pobieramy userId z requestu
        $userId = $request->input('userId');

        // Sprawdzamy, czy userId zostało przekazane
        if (!$userId) {
            return response()->json(['error' => 'userId is required'], 400);
        }

        $user = Opinions::where('user_id', $userId)->get();

        // Jeśli użytkownik nie istnieje
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Zwracamy dane użytkownika
        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $token = $request->bearerToken();

        // Sprawdź, czy token jest prawidłowy
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Zautoryzuj użytkownika na podstawie tokena
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token jest nieprawidłowy lub wygasł'], 401);
        }

        // Pobierz user_id z requestu
        $userId = $request->input('userId');

        // Rozpoczęcie transakcji bazy danych
        DB::beginTransaction();

        try {
            // Logowanie zapytań przed wykonaniem usuwania
            $usersQuery = Users::where('id', $userId)->toSql();  // Zapytanie SQL
            $purchasesQuery = Purchaces::where('user_id', $userId)->toSql();
            $qrCodesQuery = QrCodes::where('user_id', $userId)->toSql();
            $opinionsQuery = Opinions::where('user_id', $userId)->toSql();

            // Logowanie zapytań
            Log::info("Przed usunięciem zapytania SQL:");
            Log::info("Users query: " . $usersQuery);
            Log::info("Purchases query: " . $purchasesQuery);
            Log::info("QrCodes query: " . $qrCodesQuery);
            Log::info("Opinions query: " . $opinionsQuery);

            // Usuwanie danych z tabeli users
            Users::where('id', $userId)->delete();

            // Usuwanie danych z tabeli purchases
            Purchaces::where('user_id', $userId)->delete();

            // Usuwanie danych z tabeli qr_codes
            QrCodes::where('user_id', $userId)->delete();

            // Usuwanie danych z tabeli opinions
            Opinions::where('user_id', $userId)->delete();

            // Zatwierdzenie transakcji
            DB::commit();

            // Zwrócenie odpowiedzi
            return response()->json(['message' => 'Dane użytkownika zostały usunięte pomyślnie.'], 200);
        } catch (Exception $e) {
            // Wycofanie transakcji w przypadku błędu
            DB::rollBack();

            // Zwrócenie błędu
            return response()->json(['error' => 'Wystąpił błąd podczas usuwania danych.'], 500);
        }
    }
    public function updatePurchaceStatus(Request $request)
    {
        // Pobierz user_id i purchace_id z requestu
        $userId = $request->input('userId');
        $purchaceId = $request->input('purchaceId');

        // Sprawdzamy, czy wszystkie rekordy QrCodes dla podanego user_id i purchaces_id mają code_exp = 2
        $allExpired = QrCodes::where('user_id', $userId)
            ->where('purchaces_id', $purchaceId)  // Zmieniono na purchaces_id
            ->where('code_exp', '!=', 2)
            ->doesntExist();

        // Jeżeli wszystkie rekordy mają code_exp = 2, zaktualizuj status rekordu Purchace na 'history'
        if ($allExpired) {
            // Pobierz aktualną datę w formacie y-m-d
            $leadTime = now()->format('Y-m-d');  // np. "2024-11-11"

            // Zaktualizuj status zakupu na 'history' i dodaj lead_time
            Purchaces::where('user_id', $userId)
                ->where('id', $purchaceId)  // Zakładam, że w tabeli Purchace kolumna jest nazwana 'id'
                ->update([
                    'status' => 'history',
                    'lead_time' => $leadTime,  // Dodajemy lead_time w formacie y-m-d
                ]);

            return response()->json(['message' => 'Zadziałało.'], 200);  // Zwracamy komunikat "Zadziałało"
        }

        return response()->json(['message' => 'Nie zadziałało.'], 200);  // Zwracamy komunikat "Nie zadziałało"
    }
}
