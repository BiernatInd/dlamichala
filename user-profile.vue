<template>
  <header class="top-bar">
    <div class="nav">
      <div class="nav-left">
        <div class="nav-icon">
          <img src="@icons/user.svg" alt="" />
        </div>
        <div class="nav-left-data">
          <h2>{{ nickname }}</h2>
          <p>
            {{
              phone === "null"
                ? "Brak numeru telefonu"
                : phone || "Brak numeru telefonu"
            }}
          </p>
        </div>
      </div>
      <div class="nav-right">
        <router-link to="/user-edit">Edytuj profil</router-link>
      </div>
    </div>
  </header>

  <div class="opinion">
    <h2>Zdanie naszych użytkowników jest dla nas najważniejsze!</h2>
    <p>Oceń aplikację i pomóż nam wprowadzić zmiany na lepsze!</p>
    <div class="opinion-next">
      <router-link to="/user-opinion">Wystaw opinię</router-link>
      <img src="@icons/arrow-right-orange.svg" alt="" />
    </div>
  </div>

  <div class="support">
    <router-link to="/user-support">
      <div class="support-item">
        <div class="support-item-left">
          <img src="@icons/question-icon.svg" alt="" />
          <p>Pomoc i wsparcie</p>
        </div>
        <div class="support-item-right">
          <img src="@icons/arrow-right-orange.svg" alt="" />
        </div>
      </div>
    </router-link>
    <router-link to="/#contact" @click="scrollToContact">
      <div class="support-item">
        <div class="support-item-left">
          <img src="@icons/phone-icon.svg" alt="" />
          <p>Kontakt</p>
        </div>
        <div class="support-item-right">
          <img src="@icons/arrow-right-orange.svg" alt="" />
        </div>
      </div>
    </router-link>
  </div>

  <div class="home-buttons">
    <button class="home-btn" @click="redirectToShopQr">
      <p>Przejdź do sklepu internetowego</p>
      <div class="home-btn-icons">
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
    <button class="home-btn" @click="logout">
      <p>Wyloguj się</p>
      <div class="home-btn-icons">
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
      nickname: localStorage.getItem("nickname"),
      phone: localStorage.getItem("phone"),
    };
  },
  methods: {
    async access() {
      try {
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        await axios.post("http://localhost:8001/auth/user-access");
      } catch (error) {
        this.$router.push("/login");
      }
    },
    redirectToShopQr() {
      this.$router.push("/shop-qr");
    },
    async logout() {
      try {
        localStorage.clear();
        this.$router.push("/login");
      } catch (error) {
        console.error("Błąd podczas testu:", error);
      }
    },
  },
  mounted() {
    this.access();
  },
};
</script>

<style lang="scss" scoped>
.top-bar {
  border-bottom: 1px solid var(--orange);
  .nav {
    display: flex;
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    padding-bottom: 1rem;
    .nav-left {
      display: flex;
      align-items: center;
      .nav-icon {
        display: flex;
        align-items: center;
      }
      .nav-left-data {
        margin-left: 2rem;
        h2 {
          font-size: 20px;
          color: var(--white);
          font-weight: 600;
        }
        p {
          font-size: 16px;
          color: var(--white);
          font-weight: 400;
        }
      }
    }
    .nav-right {
      a {
        color: var(--orange);
        text-decoration: none;
      }
    }
  }
}

.opinion {
  width: 35%;
  margin-left: auto;
  margin-right: auto;
  background-color: var(--grey);
  border-radius: 15px;
  padding: 1rem;
  margin-top: 30px;
  h2 {
    font-size: 20px;
    color: var(--white);
    font-weight: 600;
    margin-bottom: 1rem;
  }
  p {
    font-size: 16px;
    color: var(--white);
    font-weight: 400;
    margin-bottom: 1rem;
  }
  .opinion-next {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    a {
      color: var(--orange);
      text-decoration: none;
      font-size: 16px;
      margin-right: 1rem;
    }
  }
}

.support {
  width: 35%;
  margin-left: auto;
  margin-right: auto;
  a {
    text-decoration: none;
    .support-item {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
      border-bottom: 1px solid var(--white);
      padding-bottom: 1rem;
      text-decoration: none;
      .support-item-left {
        display: flex;
        width: 100%;
        img {
          margin-right: 1rem;
        }
        p {
          color: var(--white);
          font-size: 16px;
        }
      }
    }
  }
}

.home-buttons {
  padding-bottom: 4rem;

  width: 35%;
  margin-left: auto;
  margin-right: auto;
  margin-top: 30px;
  .home-btn:first-child {
    width: 100%;
    height: 60px;
    border-radius: 10px;
    background-color: var(--transparent);
    border: 2px solid var(--white);
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    transition: 0.5s;
    margin-bottom: 30px;
    p {
      margin-left: 2rem;
      color: var(--white);
      font-size: 16px;
    }
    .home-btn-icons {
      margin-right: 2rem;
      svg {
        animation: arrow-animation-white 3s infinite;
      }
    }
    &:hover {
      scale: 1.05;
    }
  }
  .home-btn:last-child {
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
    margin-bottom: 30px;
    p {
      margin-left: 2rem;
      color: var(--white);
      font-size: 16px;
    }
    .home-btn-icons {
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
@media screen and (max-width: 1024px) {
  .top-bar {
    .nav {
      width: 90%;
      .nav-left {
        .nav-left-data {
          margin-left: 1rem;
          h2 {
            font-size: 16px;
          }
          p {
            font-size: 14px;
          }
        }
      }
      .nav-right {
        a {
          font-size: 14px;
        }
      }
    }
  }
  .opinion {
    width: 100%;
  }
  .support {
    width: 100%;
  }
  .home-buttons {
    width: 100%;
    .home-btn:first-child {
      width: 100%;
      p {
        margin-left: 1rem;
        font-size: 14px;
      }
      .home-btn-icons {
        margin-right: 1rem;
      }
    }
    .home-btn:last-child {
      width: 100%;
      p {
        margin-left: 1rem;
        font-size: 14px;
      }
      .home-btn-icons {
        margin-right: 1rem;
      }
    }
  }
}
</style>
