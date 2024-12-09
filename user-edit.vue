<template>
  <header class="header">
    <nav class="nav">
      <div class="nav-left">
        <img src="@icons/arrow-left-orange.svg" alt="" />
        <p @click="redirectToUserProfile">Powrót</p>
      </div>
    </nav>
  </header>
  <div class="home">
    <div class="home-left">
      <div class="home-left-icon">
        <img src="@icons/user.svg" alt="" />
      </div>
      <div class="home-left-name">
        <h2>{{ nickname }}</h2>
        <p>{{ phone || "Brak numeru telefonu" }}</p>
      </div>
    </div>
    <div class="home-right">
      <p @click="editProfile">Zapisz</p>
    </div>
  </div>

  <div class="home-box">
    <div class="home-box-input">
      <p>Nazwa użytkownika</p>
      <input
        type="text"
        v-model="localNickname"
        placeholder="Nazwa użytkownika"
      />
    </div>
    <div class="home-box-input">
      <p>E-mail</p>
      <input type="text" v-model="email" placeholder="E-mail" />
    </div>
    <div class="home-box-input">
      <p>Numer telefonu</p>
      <input type="text" v-model="localPhone" placeholder="Numer telefonu" />
    </div>
    <div class="home-box-input">
      <p>Data urodzenia</p>
      <input type="date" v-model="birthdayDate" placeholder="Data urodzenia" />
    </div>
    <div class="home-box-input">
      <p>Miasto</p>
      <input type="text" v-model="city" placeholder="Miasto" />
    </div>
    <div class="home-box-checkbox">
      <input type="checkbox" v-model="accepted_terms" />
      <p>
        Wyrażam zgodę na przesyłanie mi informacji handlowych oraz aktualności w
        formie wiadomości E-mail/SMS
      </p>
    </div>
  </div>
  <UserHeader />
</template>

<script>
import UserHeader from "@user-components/header.vue";
import axios from "axios";

export default {
  components: {
    UserHeader,
  },
  data() {
    // Sprawdzamy, czy wartość w localStorage to string "null", jeśli tak, przypisujemy "Brak numeru telefonu"
    return {
      nickname: localStorage.getItem("nickname") || "Brak nazwy użytkownika",
      localNickname:
        localStorage.getItem("nickname") || "Brak nazwy użytkownika", // Lokalna zmienna do edytowania

      // Jeśli phone w localStorage to "null", przypisujemy "Brak numeru telefonu"
      phone:
        localStorage.getItem("phone") === "null"
          ? "Brak numeru telefonu"
          : localStorage.getItem("phone") || "Brak numeru telefonu",
      localPhone:
        localStorage.getItem("phone") === "null"
          ? "Brak numeru telefonu"
          : localStorage.getItem("phone") || "Brak numeru telefonu", // Lokalna zmienna do edytowania

      email:
        localStorage.getItem("email") === "null"
          ? "Brak adresu E-mail"
          : localStorage.getItem("email") || "Brak adresu E-mail",

      // Inicjalizujemy jako pusty string, żeby można było pominąć to pole
      birthdayDate: localStorage.getItem("birthdayDate") || "", // Puste pole zamiast "Brak daty urodzenia"

      city:
        localStorage.getItem("city") === "null"
          ? "Brak miasta"
          : localStorage.getItem("city") || "Brak miasta",
      accepted_terms: false,
    };
  },
  methods: {
    redirectToUserProfile() {
      this.$router.push("/user-profile");
    },
    async access() {
      try {
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        await axios.post("http://localhost:8001/auth/user-access");
      } catch (error) {
        this.$router.push("/login");
      }
    },
    async editProfile() {
      if (!this.accepted_terms) {
        alert("Musisz wyrazić zgodę na przesyłanie informacji handlowych.");
        return; // Jeśli checkbox nie jest zaznaczony, nie wysyłamy danych
      }

      try {
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        const userId = localStorage.getItem("userId");

        // Przygotowanie danych do wysyłki
        const data = {
          nickname: this.localNickname, // Używamy lokalnej zmiennej
          phone: this.localPhone, // Używamy lokalnej zmiennej
          email: this.email,
          city: this.city,
          userId: userId,
        };

        // Jeśli birthdayDate jest puste, ustawiamy na null
        if (
          this.birthdayDate === "" ||
          this.birthdayDate.toLowerCase() === "null"
        ) {
          data.birthday_date = null; // Ustawiamy prawdziwe null
        } else {
          data.birthday_date = this.birthdayDate;
        }

        const response = await axios.post(
          "http://localhost:8001/user/edit-profile",
          data
        );

        alert(response.data.message);

        // Update localStorage to reflect changes
        localStorage.setItem("nickname", this.localNickname);
        localStorage.setItem("phone", this.localPhone);
        localStorage.setItem("email", this.email);
        localStorage.setItem("birthdayDate", this.birthdayDate);
        localStorage.setItem("city", this.city);

        // Synchronizujemy dane w aplikacji z tymi zapisanymi w localStorage
        this.nickname = this.localNickname; // Ustawiamy nową wartość nickname w data()
        this.phone = this.localPhone; // Ustawiamy nową wartość phone w data()
      } catch (error) {
        console.error("Failed to update user data:", error);
        alert("Nie udało się zaktualizować danych użytkownika.");
      }
    },
  },
  mounted() {
    this.access();
  },
};
</script>

<style lang="scss" scoped>
.header {
  .nav {
    display: flex;
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 1rem;
    padding-bottom: 1rem;
    .nav-left {
      display: flex;
      p {
        font-size: 20px;
        color: var(--orange);
        margin-left: 2rem;
      }
    }
  }
}

.home {
  display: flex;
  justify-content: space-between;
  align-content: center;
  width: 40%;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 1rem;
  .home-left {
    display: flex;
    align-items: center;
    .home-left-icon {
      margin-right: 1rem;
    }
    .home-left-name {
      h2 {
        font-size: 20px;
        font-weight: 600;
        color: var(--white);
      }
      p {
        font-size: 16px;
        font-weight: 400;
        color: var(--white);
      }
    }
  }
  .home-right {
    p {
      color: var(--orange);
      font-size: 16px;
      font-weight: 400;
    }
  }
}

.home-box {
  width: 40%;
  margin-left: auto;
  margin-right: auto;
  padding-bottom: 6rem;
  .home-box-input {
    p {
      font-size: 16px;
      color: var(--white);
      font-weight: 400;
      margin-bottom: 1rem;
    }
    input {
      width: 100%;
      border: 2px solid var(--white);
      background-color: var(--transparent);
      padding: 1rem;
      border-radius: 25px;
      color: var(--white);
      font-size: 16px;
      margin-bottom: 1rem;
    }
  }
  .home-box-checkbox {
    display: flex;
    align-items: center;
    input {
      width: 20px;
      height: 20px;
    }
    p {
      margin-left: 1rem;
      color: var(--white);
      font-size: 16px;
    }
  }
}

@media screen and (max-width: 1024px) {
  .home {
    width: 100%;
  }
  .home-box {
    width: 100%;
  }
}
</style>
