<template>
  <div class="home">
    <div class="home-top">
      <div class="home-searcher">
        <div class="home-searcher-input">
          <img src="@icons/searcher.svg" alt="" />
          <input type="text" placeholder="Nazwa salonu, adres" />
        </div>
      </div>
      <div class="home-map">
        <button class="home-map-btn" @click="openMap">Mapa</button>
      </div>
    </div>
    <div class="top-bar">
      <div class="top-bar-left">
        <p>Miasto</p>
        <img src="@icons/arrow-down.svg" alt="" />
      </div>
      <div class="top-bar-right">
        <img src="@icons/clock.svg" alt="" />
        <p>Otwarte salony</p>
      </div>
    </div>
    <div class="street">
      <div class="street-top">
        <p>Dzielnica</p>
        <p>Czas oczekiwania</p>
      </div>
      <div class="street-bottom-scroll">
        <div
          class="street-bottom"
          @click="setActiveSalon(salon)"
          v-for="salon in salons"
          :key="salon.id"
        >
          <div class="street-bottom-left">
            <h2>{{ salon.address }}, {{ salon.city }}</h2>
          </div>
          <div class="street-bottom-right">
            <h2>{{ salon.average_time }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div :class="['popup', { active: isPopupActive }]" v-if="activeSalon">
    <div class="popup-top">
      <div class="popup-top-left">
        <img src="@icons/arrow-left.svg" alt="" @click="closePopup" />
      </div>
      <div class="popup-top-right">
        <h2>{{ activeSalon.address }}, {{ activeSalon.city }}</h2>
      </div>
    </div>
    <div class="popup-time">
      <div class="popup-time-left">
        <p>Czas oczekiwania:</p>
        <h2>{{ activeSalon.address }}, {{ activeSalon.city }}</h2>
      </div>
      <div class="popup-time-right">
        <p>Kolejka: {{ selectedSalon?.clients_in_queue }}</p>
        <p>Fryzjerzy: {{ selectedSalon?.available_hairdressers }}</p>
      </div>
    </div>
    <div class="popup-open" @click="togglePopupTable">
      <div class="popup-open-left">
        <img src="@icons/clock-orange.svg" alt="" />
        <p>Otwarte!</p>
      </div>
      <div class="popup-open-right">
        <p>Zamknięcie o 20:00</p>
        <img src="@icons/arrow-down-orange.svg" alt="" />
      </div>
    </div>
    <div :class="['popup-table', { active: isPopupTableActive }]">
      <div class="popup-col">
        <p>Poniedziałek</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Wtorek</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Środa</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Czwartek</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Piątek</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Sobota</p>
        <p>8:00 - 20:00</p>
      </div>
      <div class="popup-col">
        <p>Niedziela</p>
        <p>Zamknięte</p>
      </div>
    </div>
  </div>
  <div :class="['map', { active: isMapActive }]">
    <div class="map-content">
      <div ref="map" class="map-item-2"></div>
      <div :class="['map-close-icon', { active: isMapActive }]">
        <img src="@icons/close-menu.svg" alt="" @click="closeMap" />
      </div>
      <div :class="['map-item', { active: isInfoActive }]">
        <div class="map-item-top">
          <!-- Wyświetlamy dane salonu, jeśli są dostępne -->
          <h2>{{ selectedSalon?.address }}</h2>
        </div>
        <div class="map-item-bottom">
          <div class="map-item-left">
            <p>Czas oczekiwania:</p>
            <h2>{{ selectedSalon?.average_time }}</h2>
          </div>
          <div class="map-item-right">
            <p>Kolejka: {{ selectedSalon?.clients_in_queue }}</p>
            <p>Fryzjerzy: {{ selectedSalon?.available_hairdressers }}</p>
          </div>
        </div>
        <div class="map-item-hours">
          <div class="map-item-hours-open" @click="toggleHoursList">
            <div class="map-item-hours-open-left">
              <img src="@icons/clock-orange.svg" alt="" />
              <p>Otwarte!</p>
            </div>
            <div class="map-item-hours-open-right">
              <p>Zamknięcie o 20:00</p>
              <img src="@icons/arrow-down-orange.svg" alt="" />
            </div>
          </div>
          <div :class="['map-item-hours-list', { active: isHoursListActive }]">
            <div class="map-item-hours-list-item">
              <p>Poniedziałek</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Wtorek</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Środa</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Czwartek</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Piątek</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Sobota</p>
              <p>10:00 - 20:00</p>
            </div>
            <div class="map-item-hours-list-item">
              <p>Niedziela</p>
              <p>Zamknięte</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="waiting-time">
    <div :class="['waiting-time-content', { active: isInfoActive }]">
      <p>Oczekiwanie: {{ selectedSalon?.average_time }}</p>
    </div>
  </div>
  <UserHeader />
</template>

<script>
import UserHeader from "@user-components/header.vue";
import { mapStyles } from "@assets/map-styles.js";
import axios from "axios";

export default {
  components: {
    UserHeader,
  },
  data() {
    return {
      isPopupActive: false,
      isPopupTableActive: false,
      isMapActive: false,
      isInfoActive: false,
      isHoursListActive: false,
      map: null,
      salons: [],
      markers: [],
      selectedSalon: null,
    };
  },
  name: "GoogleMap",
  props: {
    lat: {
      type: Number,
      required: true,
    },
    lng: {
      type: Number,
      required: true,
    },
    zoom: {
      type: Number,
      default: 8,
    },
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
    setSelectedSalon(salon) {
      this.selectedSalon = salon;
      this.isInfoActive = true;
    },
    toggleHoursList() {
      this.isHoursListActive = !this.isHoursListActive;
    },
    setActiveSalon(salon) {
      this.activeSalon = salon;
      this.isPopupActive = true;
    },
    closePopup() {
      this.isPopupActive = false;
    },
    togglePopupTable() {
      this.isPopupTableActive = !this.isPopupTableActive;
    },
    openMap() {
      this.isMapActive = true;
    },
    closeMap() {
      this.isMapActive = false;
      this.isInfoActive = false;
    },
    openInfo() {
      this.isInfoActive = !this.isInfoActive;
    },
    async fetchSalons() {
      try {
        const response = await axios.get("http://localhost:8001/user/salons");
        this.salons = response.data;
        this.updateMarkers();

        if (this.selectedSalon) {
          const updatedSalon = this.salons.find(
            (salon) => salon.id === this.selectedSalon.id
          );
          if (updatedSalon) {
            this.selectedSalon = updatedSalon;
          }
        }
      } catch (error) {
        console.error("Nie udało się pobrać danych: " + error.message);
      }
    },
    updateMarkers() {
      if (this.map) {
        // Usuń wszystkie istniejące markery z mapy
        this.markers.forEach((marker) => marker.setMap(null));
        this.markers = [];

        // Iteruj przez salony i twórz markery
        this.salons.forEach((salon) => {
          const averageTime = salon.average_time;
          const latitude = parseFloat(salon.latitude);
          const longitude = parseFloat(salon.longitude);

          const formattedTime = this.formatTime(averageTime);

          const markerSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="none">
              <circle cx="12" cy="12" r="10" fill="#e74920"></circle>
              <text x="50%" y="50%" text-anchor="middle" fill="#FFF" font-size="8px" font-weight="100" dy=".3em">${formattedTime}</text>
            </svg>`;

          const marker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: this.map,
            icon: {
              url: `data:image/svg+xml;charset=UTF-8,${encodeURIComponent(
                markerSVG
              )}`,
              anchor: new google.maps.Point(12, 12),
            },
            title: `Czas oczekiwania: ${formattedTime}`,
          });

          marker.addListener("click", () => {
            this.setSelectedSalon(salon); // Aktualizacja danych po kliknięciu
          });

          this.markers.push(marker);
        });
      }
    },
    formatTime(averageTime) {
      const timeParts = averageTime.split(" ");
      let formattedTime = "";
      if (timeParts.length === 2) {
        const hours = timeParts[0].includes("h") ? parseInt(timeParts[0]) : 0;
        const minutes = timeParts[1].includes("min")
          ? parseInt(timeParts[1])
          : 0;
        if (hours > 0) {
          formattedTime = `${hours}h`;
        } else {
          formattedTime = `${minutes}min`;
        }
      } else {
        formattedTime = timeParts[0];
      }
      return formattedTime;
    },
    async initMap() {
      const lat = 52.20119267197921; // Przykładowa szerokość geograficzna (Warszawa)
      const lng = 20.884170476939577; // Przykładowa długość geograficzna

      if (typeof google !== "undefined") {
        this.map = new google.maps.Map(this.$refs.map, {
          center: { lat, lng },
          zoom: 12,
          zoomControl: false,
          mapTypeControl: false,
          streetViewControl: false,
          fullscreenControl: false,
          styles: mapStyles,
        });

        // Wywołaj fetchSalons na początku, aby załadować dane
        await this.fetchSalons();

        // Odświeżaj salony co sekundę
        setInterval(this.fetchSalons, 60000);
      } else {
        console.error("Google Maps API not loaded.");
      }
    },
  },
  mounted() {
    this.access();
    this.initMap();
  },
};
</script>

<style lang="scss" scoped>
.waiting-time {
  display: flex;
  justify-content: center;
  align-items: center;
  .waiting-time-content {
    position: fixed;
    top: -100%;
    z-index: 999;
    background-color: var(--orange);
    padding-left: 1rem;
    padding-right: 1rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    border-radius: 25px;
    transition: 0.5s;
    p {
      color: var(--white);
    }
    &.active {
      top: 10%;
    }
  }
}
.map {
  position: fixed;
  bottom: -100%;
  background-color: var(--grey);
  z-index: 998;
  height: 100%;
  width: 100%;
  left: 0;
  transition: 0.5s;
  &.active {
    bottom: 0;
  }
  .map-content {
    display: flex;
    justify-content: center;
    .map-item-2 {
      width: 100%;
      height: 100vh;
    }
    .map-close-icon {
      position: fixed;
      top: -100%;
      right: -100%;
      transition: 0.5s;
      &.active {
        top: 5%;
        right: 5%;
      }
    }
    .map-item {
      position: fixed;
      width: 30%;
      background-color: var(--grey);
      border-radius: 15px;
      padding: 2rem;
      bottom: -100%;
      transition: 0.5s;
      &.active {
        bottom: 15%;
      }
      .map-item-top {
        margin-bottom: 1rem;

        h2 {
          font-size: 20px;
          color: var(--orange);
          font-weight: 500;
        }
      }
      .map-item-bottom {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        .map-item-left {
          p {
            font-size: 16px;
            color: var(--white);
            font-weight: 500;
          }
          h2 {
            font-size: 16px;
            color: var(--white);
            font-weight: 600;
          }
        }
        .map-item-right {
          display: flex;
          p:nth-child(1) {
            margin-right: 1rem;
          }
          p {
            font-size: 16px;
            color: var(--white);
            font-weight: 500;
          }
        }
      }
      .map-item-hours {
        .map-item-hours-open {
          display: flex;
          justify-content: space-between;
          .map-item-hours-open-left {
            display: flex;
            align-items: center;
            img {
              margin-right: 1rem;
            }
            p {
              font-size: 16px;
              color: var(--orange);
              font-weight: 500;
            }
          }
          .map-item-hours-open-right {
            display: flex;
            align-items: center;
            img {
              margin-left: 1rem;
            }
            p {
              font-size: 16px;
              color: var(--white);
              font-weight: 500;
            }
          }
        }
        .map-item-hours-list {
          display: none;
          &.active {
            display: flex;
            flex-direction: column;
          }
          .map-item-hours-list-item {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            p {
              color: var(--white);
              font-weight: 400;
              font-size: 16px;
            }
          }
        }
      }
    }
  }
}
.popup {
  position: fixed;
  bottom: -100%;
  background-color: var(--grey);
  z-index: 998;
  height: 100%;
  width: 100%;
  left: 0;
  transition: 0.5s;
  &.active {
    bottom: 0;
  }
  .popup-top {
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 1rem;
    display: flex;
    justify-content: space-between;
    .popup-top-right {
      h2 {
        font-size: 20px;
        color: var(--white);
        font-weight: 500;
      }
    }
  }
  .popup-time {
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 1rem;
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    .popup-time-left {
      p {
        color: var(--white);
        font-weight: 400;
      }
      h2 {
        font-size: 24px;
        color: var(--white);
        font-weight: 500;
      }
    }
    .popup-time-right {
      display: flex;
      p:first-child {
        margin-right: 1rem;
      }
      p {
        color: var(--white);
        font-weight: 400;
      }
    }
  }
  .popup-open {
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    display: flex;
    justify-content: space-between;
    .popup-open-left {
      display: flex;
      align-items: center;
      p {
        margin-left: 1rem;
        font-size: 16px;
        color: var(--white);
      }
    }
    .popup-open-right {
      display: flex;
      align-items: center;
      p {
        margin-right: 1rem;
        font-size: 16px;
        color: var(--white);
      }
    }
  }
  .popup-table {
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 1rem;
    display: none;
    &.active {
      display: flex;
      flex-direction: column;
    }
    .popup-col {
      width: 20%;
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
      p {
        font-size: 16px;
        color: var(--white);
      }
    }
  }
}
.street {
  .street-top {
    display: flex;
    justify-content: space-between;
    background-color: var(--grey);
    padding: 1rem;
    p {
      color: var(--white);
    }
  }
  .street-bottom-scroll {
    .street-bottom {
      display: flex;
      justify-content: space-between;
      padding-left: 1rem;
      padding-right: 1rem;
      padding-bottom: 1rem;
      padding-top: 1rem;
      cursor: pointer;
      h2 {
        color: var(--white);
        font-size: 20px;
        font-weight: 400;
      }
    }
  }
}
.home {
  padding-bottom: 5rem;
  .home-top {
    display: flex;
    justify-content: space-between;
    padding-top: 1rem;
    .home-searcher {
      width: 90%;
      .home-searcher-input {
        border-radius: 50px;
        display: flex;
        align-items: center;
        background-color: var(--grey);
        input {
          width: 100%;
          padding: 1rem;
          background-color: var(--grey);
          border-radius: 50px;
          border: none;
          font-size: 16px;
          color: var(--white);
        }
        img {
          margin-left: 1.5rem;
          margin-right: 1rem;
        }
      }
    }
    .home-map {
      display: flex;
      align-items: center;
      .home-map-btn {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 3rem;
        padding-right: 3rem;
        border-radius: 50px;
        border: 2px solid var(--orange);
        background-color: var(--transparent);
        font-size: 16px;
        color: var(--orange);
        transition: 0.5s;
        &:hover {
          transform: scale(1.05);
        }
      }
    }
  }
  .top-bar {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    margin-bottom: 1rem;
    .top-bar-left {
      display: flex;
      align-items: center;
      p {
        font-size: 20px;
        margin-right: 1rem;
        color: var(--white);
        font-weight: 400;
      }
    }
    .top-bar-right {
      display: flex;
      align-items: center;
      padding-left: 3rem;
      padding-right: 3rem;
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
      border-radius: 25px;
      border: 2px solid var(--white);
      img {
        margin-right: 1rem;
      }
      p {
        color: var(--white);
        font-size: 16px;
        font-weight: 400;
      }
    }
  }
}

@media screen and (max-width: 1024px) {
  .home {
    .home-top {
      flex-direction: column;
      .home-searcher {
        margin-bottom: 1rem;
        width: 100%;
      }
      .home-map {
        .home-map-btn {
          width: 100%;
        }
      }
    }
  }
  .top-bar {
    .top-bar-left {
      p {
        font-size: 16px !important;
      }
    }
    .top-bar-right {
      padding-left: 1rem !important;
      padding-right: 1rem !important;
      padding-top: 0.5rem !important;
      padding-bottom: 0.5rem !important;
      p {
        font-size: 16px;
      }
    }
  }
  .street {
    .street-top {
      p {
        font-size: 16px;
      }
    }
    .street-bottom-scroll {
      .street-bottom {
        h2 {
          font-size: 16px;
        }
      }
    }
  }

  .popup {
    .popup-top {
      width: 90%;
    }
    .popup-time {
      width: 90%;
      .popup-time-left {
        p {
          font-size: 16px;
        }
        h2 {
          font-size: 16px;
        }
      }
      .popup-time-right {
        p {
          font-size: 16px;
        }
      }
    }
    .popup-open {
      width: 90%;
    }
    .popup-table {
      width: 90%;
      .popup-col {
        width: 100%;
      }
    }
  }

  .map {
    .map-content {
      .map-close-icon {
        &.active {
          top: 5%;
          right: 5%;
        }
      }
      .map-item {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        padding: 1rem;
        .map-item-top {
          h2 {
            font-size: 20px;
          }
        }
        .map-item-bottom {
          .map-item-left {
            p {
              font-size: 14px;
            }
            h2 {
              font-size: 14px;
            }
          }
          .map-item-right {
            flex-direction: column;
            p {
              font-size: 14px;
            }
          }
        }
        .map-item-hours {
          .map-item-hours-open {
            .map-item-hours-open-left {
              p {
                font-size: 14px;
              }
            }
            .map-item-hours-open-right {
              p {
                font-size: 14px;
              }
            }
          }
          .map-item-hours-list {
            .map-item-hours-list-item {
              p {
                font-size: 14px;
              }
            }
          }
        }
      }
    }
  }
}
</style>
