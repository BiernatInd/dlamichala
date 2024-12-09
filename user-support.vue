<template>
  <header class="header">
    <nav class="nav">
      <div class="nav-left" @click="redirectToUserProfile">
        <img src="@icons/arrow-left-orange.svg" alt="" />
        <p>Powrót</p>
      </div>
    </nav>
  </header>
  <div class="home">
    <h1>Pomoc i wsparcie</h1>
    <div class="home-item" @click="redirectToMainPage">
      <img src="@icons/question-icon.svg" alt="" />
      <p>O CutPoint</p>
    </div>
    <div class="home-item" @click="redirectToPolicyPrivacy">
      <img src="@icons/document.svg" alt="" />
      <p>Regulamin i Polityka prywatności</p>
    </div>
    <div class="home-item" @click="redirectToUserDeleteAccount">
      <img src="@icons/user-icon-orange.svg" alt="" />
      <p>Usuń swoje konto</p>
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
  methods: {
    redirectToMainPage() {
      this.$router.push("/");
    },
    redirectToPolicyPrivacy() {
      this.$router.push("/policy-privacy");
    },
    redirectToUserDeleteAccount() {
      this.$router.push("/user-delete-account");
    },
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
  },
  mounted() {
    this.access;
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
  width: 40%;
  margin-left: auto;
  margin-right: auto;
  h1 {
    text-align: center;
    font-size: 20px;
    color: var(--white);
    font-weight: 600;
  }
  .home-item {
    display: flex;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--white);
    padding-top: 1rem;
    align-items: center;
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
}
</style>
