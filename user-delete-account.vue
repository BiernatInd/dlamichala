<template>
  <header class="header">
    <nav class="nav">
      <div class="nav-left" @click="redirectToUserSupport">
        <img src="@icons/arrow-left-orange.svg" alt="" />
        <p>Powrót</p>
      </div>
    </nav>
  </header>

  <div class="home">
    <h1>Usuń konto</h1>
    <div class="home-box">
      <h2>Czy napewno chcesz usunąć swoje konto?</h2>
      <p>Jeśli usuniesz konto stracisz wszystkie swoje dane.</p>
      <div class="home-box-button">
        <a href="#" @click="deleteUser">Usuń konto</a>
        <img src="@icons/arrow-right-orange.svg" alt="" />
      </div>
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
    redirectToUserSupport() {
      this.$router.push("/user-support");
    },
    async deleteUser() {
      try {
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        const userId = localStorage.getItem("userId");

        const response = await axios.post(
          "http://localhost:8001/user/delete-user",
          { userId }
        );
        console.log(response.data);
        alert("Konto i dane z nim powiązane zostały usuniete prawidłowo");
        this.logout();
      } catch (error) {
        console.error("Wystąpił błąd podczas wysyłania danych:", error);
      }
    },
    async logout() {
      try {
        localStorage.clear();
        this.$router.push("/login");
      } catch (error) {
        console.error("Błąd podczas testu:", error);
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
  width: 40%;
  margin-left: auto;
  margin-right: auto;
  h1 {
    font-size: 20px;
    color: var(--white);
    font-weight: 600;
    text-align: center;
    margin-bottom: 1rem;
  }
  .home-box {
    padding: 1rem;
    background-color: var(--grey);
    border-radius: 15px;
    h2 {
      font-size: 20px;
      font-weight: 600;
      color: var(--white);
      margin-bottom: 1rem;
    }
    p {
      font-size: 16px;
      color: var(--white);
      font-weight: 400;
      margin-bottom: 1rem;
    }
    .home-box-button {
      display: flex;
      justify-content: flex-end;
      a {
        color: var(--orange);
        text-decoration: none;
        color: var(--orange);
        font-size: 16px;
        margin-right: 1rem;
      }
    }
  }
}

@media screen and (max-width: 1024px) {
  .home {
    width: 100%;
  }
}
</style>
