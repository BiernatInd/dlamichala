<template>
  <div class="header">
    <div class="nav">
      <div class="nav-left">
        <img src="@icons/arrow-left-orange.svg" alt="" />
        <p>Powrót</p>
      </div>
    </div>
  </div>

  <div class="home">
    <h1>Twoja opinia</h1>
    <p>
      Opinię możesz wystawić tylko raz. Wystawionej opinii nie można edytować.
    </p>
    <h2>Czy aplikacja CutPoint spełnia twoje oczekiwania?</h2>
    <p>Twoja opinia pomoże nam w rozwoju.</p>
    <div class="home-buttons">
      <button class="home-btn" :class="getButtonClass(1)">
        <svg
          width="31"
          height="31"
          viewBox="0 0 31 31"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M18.2293 1.32944C19.4058 2.18968 20.0004 3.66346 20.0004 5.69386V10.5137H26.6799C29.0582 10.5137 31 12.4492 31 14.8338V14.9667C31 15.0046 30.9937 15.0489 30.9873 15.0868L29.21 26.2509C28.881 28.9328 27.0088 30.4761 24.0802 30.4761H10.8478C8.4695 30.4761 6.52765 28.5406 6.52765 26.156V13.7522C6.52765 13.379 6.22404 13.0754 5.85085 13.0754H2.22649C1.8533 13.0754 1.54968 13.379 1.54968 13.7522V26.9024C1.54968 27.2756 1.8533 27.5792 2.22649 27.5792H4.32014C4.75026 27.5792 5.09814 27.9271 5.09814 28.3572C5.09814 28.7873 4.75026 29.1352 4.32014 29.1352H2.22649C0.999389 29.1352 -9.77245e-08 28.1358 -9.77245e-08 26.9087V13.7522C-9.77245e-08 12.5251 0.999389 11.5257 2.22649 11.5257H5.85085C6.72373 11.5257 7.48276 12.0318 7.84962 12.7655C7.90022 12.7339 7.95715 12.7149 8.0204 12.6959C8.22914 12.639 13.1691 11.1905 13.1691 6.92728V1.51288C13.1691 1.17131 13.3905 0.874028 13.7131 0.772824C13.8143 0.741198 16.3697 -0.0368068 18.2293 1.32944ZM8.43155 14.1823C8.31137 14.214 8.19119 14.2203 8.07733 14.195V26.156C8.07733 27.6804 9.31708 28.9265 10.8478 28.9265H15.0477H24.0802C26.2308 28.9265 27.4389 27.965 27.6792 26.0358L29.4503 14.9034V14.8338C29.4503 13.3094 28.2106 12.0634 26.6799 12.0634H19.2224C18.7923 12.0634 18.4444 11.7155 18.4444 11.2854V5.69386C18.4444 4.18213 18.0649 3.13846 17.3122 2.58184C16.4962 1.97462 15.3703 2.03155 14.7125 2.13908V6.92096C14.7125 12.3607 8.69088 14.1128 8.43155 14.1823Z"
            fill="white"
          />
        </svg>
      </button>
      <button class="home-btn" :class="getButtonClass(2)">
        <svg
          width="31"
          height="31"
          viewBox="0 0 31 31"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M18.2293 29.6706C19.4058 28.8103 20.0004 27.3365 20.0004 25.3061V20.4863H26.6799C29.0582 20.4863 31 18.5508 31 16.1662V16.0333C31 15.9954 30.9937 15.9511 30.9873 15.9132L29.21 4.74911C28.881 2.06721 27.0088 0.523851 24.0802 0.523851H10.8478C8.4695 0.523851 6.52765 2.45937 6.52765 4.84399V17.2478C6.52765 17.621 6.22404 17.9246 5.85085 17.9246H2.22649C1.8533 17.9246 1.54968 17.621 1.54968 17.2478V4.09761C1.54968 3.72442 1.8533 3.42081 2.22649 3.42081H4.32014C4.75026 3.42081 5.09814 3.07292 5.09814 2.64281C5.09814 2.21269 4.75026 1.8648 4.32014 1.8648H2.22649C0.999389 1.8648 -9.77245e-08 2.86419 -9.77245e-08 4.09129V17.2478C-9.77245e-08 18.4749 0.999389 19.4743 2.22649 19.4743H5.85085C6.72373 19.4743 7.48276 18.9682 7.84962 18.2345C7.90022 18.2661 7.95715 18.2851 8.0204 18.3041C8.22914 18.361 13.1691 19.8095 13.1691 24.0727V29.4871C13.1691 29.8287 13.3905 30.126 13.7131 30.2272C13.8143 30.2588 16.3697 31.0368 18.2293 29.6706ZM8.43155 16.8177C8.31137 16.786 8.19119 16.7797 8.07733 16.805V4.84399C8.07733 3.31961 9.31708 2.07353 10.8478 2.07353H15.0477H24.0802C26.2308 2.07353 27.4389 3.03497 27.6792 4.96417L29.4503 16.0966V16.1662C29.4503 17.6906 28.2106 18.9366 26.6799 18.9366H19.2224C18.7923 18.9366 18.4444 19.2845 18.4444 19.7146V25.3061C18.4444 26.8179 18.0649 27.8615 17.3122 28.4182C16.4962 29.0254 15.3703 28.9685 14.7125 28.8609V24.079C14.7125 18.6393 8.69088 16.8872 8.43155 16.8177Z"
            fill="white"
          />
        </svg>
      </button>
    </div>
  </div>

  <div class="opinion">
    <div class="opinion-item">
      <p class="opinion-item-p">Obsługa aplikacji</p>
      <div class="opinion-item-stars">
        <svg
          v-for="(star, index) in 5"
          :key="index"
          width="22"
          height="22"
          viewBox="0 0 55 55"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          :class="{ active: index + 1 <= activeStars }"
        >
          <path
            d="M29.251 2.1534L29.251 2.15342L35.4543 15.2968C35.4543 15.2968 35.4543 15.2968 35.4543 15.2968C36.0218 16.4993 37.1308 17.3541 38.4387 17.5526C38.4388 17.5526 38.4389 17.5526 38.439 17.5526L52.3103 19.6603C53.8743 19.8982 54.6177 22.0009 53.3886 23.2534L53.3886 23.2534L43.3511 33.4841L43.3509 33.4843C42.4249 34.4286 42.0112 35.7768 42.2269 37.088L44.5959 51.5337L44.5959 51.5338C44.8931 53.3442 43.1182 54.5034 41.7665 53.7608L29.3602 46.9409L29.3599 46.9408C28.1973 46.3022 26.8027 46.3022 25.6401 46.9408L25.6398 46.9409L13.2332 53.761L13.2331 53.761C11.8823 54.5038 10.1067 53.3451 10.4041 51.5338L10.4041 51.5337L12.7731 37.088C12.7731 37.0878 12.7732 37.0876 12.7732 37.0875C12.9887 35.7765 12.575 34.4285 11.6491 33.4843L11.6489 33.4841L1.61159 23.2536C1.61154 23.2535 1.61148 23.2535 1.61143 23.2534C0.381631 21.9991 1.12656 19.8973 2.68922 19.6604L2.68959 19.6603L16.561 17.5526C16.5611 17.5526 16.5612 17.5526 16.5613 17.5526C17.8692 17.3541 18.9782 16.4993 19.5457 15.2968C19.5457 15.2968 19.5457 15.2968 19.5457 15.2968L25.749 2.15342L25.7492 2.15303C26.4738 0.616061 28.525 0.61513 29.251 2.1534Z"
            stroke-width="2"
          />
        </svg>
      </div>
    </div>
    <div class="opinion-item">
      <p class="opinion-item-p">Łatwość znalezienia salonu</p>
      <div class="opinion-item-stars">
        <svg
          v-for="(star, index) in 5"
          :key="index"
          width="22"
          height="22"
          viewBox="0 0 55 55"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          :class="{ active: index + 1 <= activeStars2 }"
        >
          <path
            d="M29.251 2.1534L29.251 2.15342L35.4543 15.2968C35.4543 15.2968 35.4543 15.2968 35.4543 15.2968C36.0218 16.4993 37.1308 17.3541 38.4387 17.5526C38.4388 17.5526 38.4389 17.5526 38.439 17.5526L52.3103 19.6603C53.8743 19.8982 54.6177 22.0009 53.3886 23.2534L53.3886 23.2534L43.3511 33.4841L43.3509 33.4843C42.4249 34.4286 42.0112 35.7768 42.2269 37.088L44.5959 51.5337L44.5959 51.5338C44.8931 53.3442 43.1182 54.5034 41.7665 53.7608L29.3602 46.9409L29.3599 46.9408C28.1973 46.3022 26.8027 46.3022 25.6401 46.9408L25.6398 46.9409L13.2332 53.761L13.2331 53.761C11.8823 54.5038 10.1067 53.3451 10.4041 51.5338L10.4041 51.5337L12.7731 37.088C12.7731 37.0878 12.7732 37.0876 12.7732 37.0875C12.9887 35.7765 12.575 34.4285 11.6491 33.4843L11.6489 33.4841L1.61159 23.2536C1.61154 23.2535 1.61148 23.2535 1.61143 23.2534C0.381631 21.9991 1.12656 19.8973 2.68922 19.6604L2.68959 19.6603L16.561 17.5526C16.5611 17.5526 16.5612 17.5526 16.5613 17.5526C17.8692 17.3541 18.9782 16.4993 19.5457 15.2968C19.5457 15.2968 19.5457 15.2968 19.5457 15.2968L25.749 2.15342L25.7492 2.15303C26.4738 0.616061 28.525 0.61513 29.251 2.1534Z"
            stroke-width="2"
          />
        </svg>
      </div>
    </div>
    <div class="opinion-item">
      <p class="opinion-item-p">Ogólne wrażenia</p>
      <div class="opinion-item-stars">
        <svg
          v-for="(star, index) in 5"
          :key="index"
          width="22"
          height="22"
          viewBox="0 0 55 55"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          :class="{ active: index + 1 <= activeStars3 }"
        >
          <path
            d="M29.251 2.1534L29.251 2.15342L35.4543 15.2968C35.4543 15.2968 35.4543 15.2968 35.4543 15.2968C36.0218 16.4993 37.1308 17.3541 38.4387 17.5526C38.4388 17.5526 38.4389 17.5526 38.439 17.5526L52.3103 19.6603C53.8743 19.8982 54.6177 22.0009 53.3886 23.2534L53.3886 23.2534L43.3511 33.4841L43.3509 33.4843C42.4249 34.4286 42.0112 35.7768 42.2269 37.088L44.5959 51.5337L44.5959 51.5338C44.8931 53.3442 43.1182 54.5034 41.7665 53.7608L29.3602 46.9409L29.3599 46.9408C28.1973 46.3022 26.8027 46.3022 25.6401 46.9408L25.6398 46.9409L13.2332 53.761L13.2331 53.761C11.8823 54.5038 10.1067 53.3451 10.4041 51.5338L10.4041 51.5337L12.7731 37.088C12.7731 37.0878 12.7732 37.0876 12.7732 37.0875C12.9887 35.7765 12.575 34.4285 11.6491 33.4843L11.6489 33.4841L1.61159 23.2536C1.61154 23.2535 1.61148 23.2535 1.61143 23.2534C0.381631 21.9991 1.12656 19.8973 2.68922 19.6604L2.68959 19.6603L16.561 17.5526C16.5611 17.5526 16.5612 17.5526 16.5613 17.5526C17.8692 17.3541 18.9782 16.4993 19.5457 15.2968C19.5457 15.2968 19.5457 15.2968 19.5457 15.2968L25.749 2.15342L25.7492 2.15303C26.4738 0.616061 28.525 0.61513 29.251 2.1534Z"
            stroke-width="2"
          />
        </svg>
      </div>
    </div>
    <div class="opinion-item">
      <p class="opinion-item-p">Co podobało ci się najbardziej?</p>
      <div class="opinion-item-box">
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Ładny wygląd') }"
        >
          <p>Ładny wygląd</p>
        </div>
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Intuicyjność aplikacji') }"
        >
          <p>Intuicyjność aplikacji</p>
        </div>
      </div>

      <div class="opinion-item-box">
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Prostota') }"
        >
          <p>Prostota</p>
        </div>
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Pomoc w znalezieniu salonu') }"
        >
          <p>Pomoc w znalezieniu salonu</p>
        </div>
      </div>

      <div class="opinion-item-box">
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Łatwość dostępu do kodu QR') }"
        >
          <p>Łatwość dostępu do kodu QR</p>
        </div>
        <div
          class="opinion-item-box-item"
          :class="{ active: isActive('Historia usług') }"
        >
          <p>Historia usług</p>
        </div>
      </div>
    </div>
  </div>
  <div class="send">
    <div class="send-button">
      <button class="send-btn">
        <p>Przejdź do sklepu internetowego</p>
        <div class="send-btn-icons">
          <svg
            class="btn-icons-arrow"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M6.96912 2.46936C7.03879 2.39952 7.12155 2.34411 7.21267 2.3063C7.30379 2.26849 7.40147 2.24902 7.50012 2.24902C7.59877 2.24902 7.69645 2.26849 7.78757 2.3063C7.87869 2.34411 7.96145 2.39952 8.03112 2.46936L17.0311 11.4694C17.101 11.539 17.1564 11.6218 17.1942 11.7129C17.232 11.804 17.2515 11.9017 17.2515 12.0004C17.2515 12.099 17.232 12.1967 17.1942 12.2878C17.1564 12.3789 17.101 12.4617 17.0311 12.5314L8.03112 21.5314C7.89029 21.6722 7.69928 21.7513 7.50012 21.7513C7.30096 21.7513 7.10995 21.6722 6.96912 21.5314C6.82829 21.3905 6.74917 21.1995 6.74917 21.0004C6.74917 20.8012 6.82829 20.6102 6.96912 20.4694L15.4396 12.0004L6.96912 3.53136C6.89927 3.4617 6.84386 3.37893 6.80605 3.28781C6.76824 3.1967 6.74878 3.09902 6.74878 3.00036C6.74878 2.90171 6.76824 2.80403 6.80605 2.71291C6.84386 2.6218 6.89927 2.53903 6.96912 2.46936V2.46936Z"
              fill="#FEFFFF"
            />
          </svg>
          <svg
            class="btn-icons-arrow"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="animation-delay: 1s"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M6.96912 2.46936C7.03879 2.39952 7.12155 2.34411 7.21267 2.3063C7.30379 2.26849 7.40147 2.24902 7.50012 2.24902C7.59877 2.24902 7.69645 2.26849 7.78757 2.3063C7.87869 2.34411 7.96145 2.39952 8.03112 2.46936L17.0311 11.4694C17.101 11.539 17.1564 11.6218 17.1942 11.7129C17.232 11.804 17.2515 11.9017 17.2515 12.0004C17.2515 12.099 17.232 12.1967 17.1942 12.2878C17.1564 12.3789 17.101 12.4617 17.0311 12.5314L8.03112 21.5314C7.89029 21.6722 7.69928 21.7513 7.50012 21.7513C7.30096 21.7513 7.10995 21.6722 6.96912 21.5314C6.82829 21.3905 6.74917 21.1995 6.74917 21.0004C6.74917 20.8012 6.82829 20.6102 6.96912 20.4694L15.4396 12.0004L6.96912 3.53136C6.89927 3.4617 6.84386 3.37893 6.80605 3.28781C6.76824 3.1967 6.74878 3.09902 6.74878 3.00036C6.74878 2.90171 6.76824 2.80403 6.80605 2.71291C6.84386 2.6218 6.89927 2.53903 6.96912 2.46936V2.46936Z"
              fill="#FEFFFF"
            />
          </svg>
          <svg
            class="btn-icons-arrow"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="animation-delay: 2s"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M6.96912 2.46936C7.03879 2.39952 7.12155 2.34411 7.21267 2.3063C7.30379 2.26849 7.40147 2.24902 7.50012 2.24902C7.59877 2.24902 7.69645 2.26849 7.78757 2.3063C7.87869 2.34411 7.96145 2.39952 8.03112 2.46936L17.0311 11.4694C17.101 11.539 17.1564 11.6218 17.1942 11.7129C17.232 11.804 17.2515 11.9017 17.2515 12.0004C17.2515 12.099 17.232 12.1967 17.1942 12.2878C17.1564 12.3789 17.101 12.4617 17.0311 12.5314L8.03112 21.5314C7.89029 21.6722 7.69928 21.7513 7.50012 21.7513C7.30096 21.7513 7.10995 21.6722 6.96912 21.5314C6.82829 21.3905 6.74917 21.1995 6.74917 21.0004C6.74917 20.8012 6.82829 20.6102 6.96912 20.4694L15.4396 12.0004L6.96912 3.53136C6.89927 3.4617 6.84386 3.37893 6.80605 3.28781C6.76824 3.1967 6.74878 3.09902 6.74878 3.00036C6.74878 2.90171 6.76824 2.80403 6.80605 2.71291C6.84386 2.6218 6.89927 2.53903 6.96912 2.46936V2.46936Z"
              fill="#FEFFFF"
            />
          </svg>
        </div>
      </button>
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
    return {
      activeButton: 1, // Domyślna wartość dla activeButton
      activeStars: 1, // Domyślna liczba aktywnych gwiazdek
      activeStars2: 2, // Domyślna liczba aktywnych gwiazdek
      activeStars3: 3, // Domyślna liczba aktywnych gwiazdek
      activeItems: ["Prostota"], // Domyślnie aktywne elementy

      opinion: null, // Zmienna, która przechowa dane opinii
    };
  },
  methods: {
    setActiveStars(starIndex) {
      console.log("Kliknięto gwiazdkę nr: ", starIndex);
      this.activeStars = starIndex;
    },
    setActiveStars2(starIndex2) {
      console.log("Kliknięto gwiazdkę nr: ", starIndex2);
      this.activeStars2 = starIndex2;
    },
    setActiveStars3(starIndex3) {
      console.log("Kliknięto gwiazdkę nr: ", starIndex3);
      this.activeStars3 = starIndex3;
    },
    getButtonClass(buttonNumber) {
      return buttonNumber === this.activeButton ? "active" : "";
    },
    isActive(itemText) {
      return this.activeItems.includes(itemText);
    },
    async userOpinion() {
      try {
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        const userId = localStorage.getItem("userId");

        const response = await axios.post(
          "http://localhost:8001/user/user-opinion",
          { userId }
        );
        console.log(response.data);

        // Zakładamy, że odpowiedź to tablica, a my interesujemy się pierwszym elementem
        const data = response.data[0];

        // Ustawianie icon na podstawie wartości "like" lub "unlike"
        this.activeButton =
          data.icon === "like" ? 1 : data.icon === "unlike" ? 2 : 1;

        // Ustawianie liczby gwiazdek
        this.activeStars = data.app_support || 1;
        this.activeStars2 = data.easy_to_find || 1;
        this.activeStars3 = data.impressions || 1;

        // Ustawianie activeItems jako tablica z wartości options
        this.activeItems = data.options
          ? data.options.split(",").map((option) => option.trim())
          : ["Prostota"];
      } catch (error) {
        console.error("Wystąpił błąd podczas wysyłania danych:", error);
      }
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
  },
  mounted() {
    this.userOpinion(); // Teraz metoda userOpinion jest wywoływana w momencie załadowania komponentu
    this.access(); // Użycie metody do autoryzacji, jeśli jest potrzebna
  },
};
</script>

<style lang="scss" scoped>
.popup {
  position: fixed;
  width: 100%;
  bottom: 10%;
  left: 0;
  .popup-box {
    width: 30%;
    margin-left: auto;
    margin-right: auto;
    padding: 1rem;
    background-color: var(--grey);
    border-radius: 15px;
    h2 {
      font-size: 20px;
      color: var(--white);
      font-weight: 600;
      margin-bottom: 1rem;
    }
    p {
      font-size: 16px;
      color: var(--white);
      margin-bottom: 1rem;
    }
    .popup-btn {
      display: flex;
      justify-content: flex-end;
      a {
        color: var(--orange);
        text-decoration: none;
        font-size: 16px;
        margin-right: 1rem;
      }
    }
  }
}
.opinion {
  width: 40%;
  margin-left: auto;
  margin-right: auto;
  padding-top: 30px;
  border-top: 1px solid var(--white);
  .opinion-item {
    .opinion-item-p {
      font-size: 16px;
      color: var(--white);
      font-weight: 400;
      margin-bottom: 1rem;
    }
    .opinion-item-stars {
      margin-bottom: 1rem;
      svg:not(:last-child) {
        margin-right: 1rem;
      }
      svg {
        path {
          stroke: var(--white);
        }
        &.active {
          path {
            stroke: var(--orange);
            fill: var(--orange);
          }
        }
      }
    }
    .opinion-item-box {
      display: flex;
      margin-bottom: 1rem;
      .opinion-item-box-item:first-child {
        margin-right: 1rem;
      }
      .opinion-item-box-item {
        border: 1px solid var(--white);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 3rem;
        padding-right: 3rem;
        border-radius: 5px;
        p {
          font-size: 16px;
          color: var(--white);
          font-weight: 400;
        }
        &.active {
          border: 1px solid var(--orange);
          p {
            color: var(--orange);
          }
        }
      }
    }
  }
}
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
  padding-bottom: 30px;
  h1 {
    font-size: 20px;
    text-align: center;
    color: var(--white);
    font-weight: 400;
    margin-bottom: 30px;
  }
  h2 {
    font-size: 24px;
    color: var(--white);
    text-align: center;
    font-weight: 600;
    margin-bottom: 30px;
  }
  p {
    font-size: 20px;
    color: var(--white);
    font-weight: 400;
    text-align: center;
    margin-bottom: 30px;
  }
  .home-buttons {
    width: 30%;
    margin-left: auto;
    margin-right: auto;
    display: flex;
    justify-content: center;
    .home-btn:first-child {
      margin-right: 30px;
      background-color: var(--light-black);
      border: 2px solid var(--white);
      border-radius: 10px;
      padding: 1rem;
      &.active {
        border: 2px solid var(--orange);
        svg {
          path {
            fill: var(--orange);
          }
        }
      }
    }
  }
  .home-btn:last-child {
    background-color: var(--light-black);
    border: 2px solid var(--white);
    border-radius: 10px;
    padding: 1rem;
    &.active {
      border: 2px solid var(--orange);
      svg {
        path {
          fill: var(--orange);
        }
      }
    }
  }
}

.send {
  padding-bottom: 6rem;
  .send-button {
    width: 40%;
    margin-left: auto;
    margin-right: auto;
    .send-btn:first-child {
      width: 100%;
      height: 60px;
      border-radius: 10px;
      background-color: var(--orange);
      border: 2px solid var(--orange);
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      transition: 0.5s;
      p {
        margin-left: 2rem;
        color: var(--white);
        font-size: 16px;
      }
      .send-btn-icons {
        margin-right: 2rem;
        svg {
          animation: arrow-animation-white 3s infinite;
        }
      }
      &:hover {
        scale: 1.05;
      }
    }
  }
}

@media screen and (max-width: 1024px) {
  .home {
    h1 {
      font-size: 16px;
    }
    h2 {
      font-size: 20px;
    }
    p {
      font-size: 16px;
    }
  }
  .opinion {
    width: 100%;
    .opinion-item {
      .opinion-item-box {
        .opinion-item-box-item {
          padding-left: 0.5rem;
          padding-right: 0.5rem;
          p {
            font-size: 14px;
          }
        }
      }
    }
  }
  .send {
    .send-button {
      width: 100%;
    }
  }
}
</style>
