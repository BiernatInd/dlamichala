<template>
  <div class="top-bar">
    <div class="top-bar-content">
      <div class="top-bar-item-active">
        <p>Aktywne</p>
      </div>
      <div class="top-bar-item" @click="redirectToUserPurchaseHistory">
        <p>Historia</p>
      </div>
    </div>
  </div>
  <div class="scroll" v-if="purchaces.length > 0">
    <div class="table">
      <div class="table-col">
        <p>Rodzaj usługi</p>
      </div>
      <div class="table-col">
        <p>Ilość</p>
      </div>
      <div class="table-col">
        <p>Cena</p>
      </div>
    </div>
    <div class="service">
      <div
        class="service-item"
        v-for="purchace in purchaces"
        :key="purchace.id"
      >
        <div class="service-item-top" @click="toggleService(purchace)">
          <div class="service-col-left">
            <img src="@icons/scissors-icon-2.svg" alt="" />
            <p>Usługa strzyżenia</p>
          </div>
          <div class="service-col-center">
            <p>{{ purchace.quantity }}</p>
          </div>
          <div class="service-col-right">
            <p>{{ purchace.price }}.00 PLN</p>
            <img src="@icons/arrow-down-orange.svg" alt="" />
          </div>
        </div>
        <div class="service-item-bottom">
          <div :class="['qr-code', { active: purchace.isActive }]">
            <div class="qr-code-top">
              <p>Data zakupu</p>
              <p>{{ formatDate(purchace.created_at) }}</p>
            </div>
            <div class="qr-code-status">
              <p>Status płatności</p>
              <p>{{ formatPaymentStatus(purchace.payment_status) }}</p>
            </div>
            <div
              class="qr-code-flex"
              v-for="(qrCode, index) in purchace.qrCodes"
              :key="index"
            >
              <div class="qr-code-img">
                <img :src="qrCode.qrImage" alt="QR Code" />
              </div>
              <div class="qr-code-info">
                <div class="qr-code-info-top">
                  <p>Kod QR</p>
                  <h2>Kod: {{ qrCode.code }}</h2>
                  <h2>Status: {{ getCodeStatus(qrCode.code_exp) }}</h2>
                </div>
                <div class="qr-code-info-bottom">
                  <p>
                    Aby wykorzystać usługę zeskanuj QR lub wpisz kod na ekranie
                  </p>
                </div>
              </div>
            </div>

            <div class="qr-code-button">
              <button class="qr-code-btn" @click="downloadQrCodes">
                <p>Pobierz kody QR</p>
                <div class="qr-code-btn-icons">
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
        </div>
      </div>
    </div>
  </div>
  <div class="none-text" v-else>
    <h2>Nie znaleziono aktywnych usług</h2>
  </div>
  <UserHeader />
</template>

<script>
import UserHeader from "@user-components/header.vue";
import axios from "axios";
import QRCode from "qrcode";

export default {
  components: {
    UserHeader,
  },
  data() {
    return {
      purchaces: [],
      qrCodes: [],
    };
  },
  methods: {
    redirectToUserPurchaseHistory() {
      this.$router.push("/user-purchase-history");
    },
    toggleService(purchace) {
      purchace.isActive = !purchace.isActive;

      // Jeśli zmieniamy stan na aktywny, pobierz kody QR tylko dla tej konkretnej usługi
      if (purchace.isActive) {
        this.fetchQrCodePurchaces(purchace.id);
      }

      // Wywołanie updatePurchaceStatus z purchace.id
      this.updatePurchaceStatus(purchace.id);
    },

    getCodeStatus(codeExp) {
      if (codeExp === 1) {
        return "Aktywny";
      } else if (codeExp === 2) {
        return "Użyty/Wygasł";
      } else {
        return ""; // Zwraca pusty ciąg, jeśli wartość code_exp jest inna
      }
    },

    async downloadQrCodes() {
      try {
        // Przechodzimy przez wszystkie zakupy, które mają kody QR
        for (let i = 0; i < this.purchaces.length; i++) {
          const purchace = this.purchaces[i];

          // Jeżeli ten zakup ma kody QR
          if (purchace.qrCodes && purchace.qrCodes.length > 0) {
            for (let j = 0; j < purchace.qrCodes.length; j++) {
              const qrCode = purchace.qrCodes[j];

              // Generujemy URL dla każdego QR kodu
              const qrImage = await QRCode.toDataURL(qrCode.code, {
                width: 150,
                height: 150,
              });

              // Tworzymy link do pobrania obrazu
              const link = document.createElement("a");
              link.href = qrImage;
              link.download = `qr_code_${i + 1}_${j + 1}.png`; // Unikalna nazwa pliku

              // Opóźniamy kliknięcie, żeby nie zaczęło się od razu
              setTimeout(() => {
                link.click();
              }, (i * purchace.qrCodes.length + j) * 500); // Opóźnienie między kolejnymi pobraniami
            }
          }
        }
      } catch (error) {
        console.error("Error generating QR codes for download:", error);
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
    async activePurchaces() {
      try {
        const userId = localStorage.getItem("userId");
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        if (!userId) {
          throw new Error("User ID not found in localStorage.");
        }

        const response = await axios.post(
          "http://localhost:8001/user/active-purchaces",
          {
            userId: userId,
          }
        );

        // Jeśli dane zostały pobrane, przypisz je do purchaces
        this.purchaces = response.data.map((purchace) => ({
          ...purchace,
          isActive: false,
        }));
      } catch (error) {
        console.error("Error fetching active purchaces:", error);
        this.purchaces = []; // Ustawienie na pustą tablicę w przypadku błędu
      }
    },
    async updatePurchaceStatus(purchaceId) {
      try {
        const userId = localStorage.getItem("userId");
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        console.log("Request Data:", {
          userId: userId,
          purchaceId: purchaceId,
        });

        const response = await axios.post(
          "http://localhost:8001/user/update-purchace-status",
          {
            userId: userId,
            purchaceId: purchaceId, // Przekazujemy purchaceId do żądania
          }
        );

        // Zaktualizuj statusMessage na komunikat zwrócony przez serwer
        this.statusMessage = response.data.message;

        // Jeżeli status został zaktualizowany na 'history', usuń ten zakup z listy
        if (response.data.message === "Zadziałało.") {
          // Zaktualizowanie listy purchaces, usuwając zakup, którego status został zmieniony
          this.purchaces = this.purchaces.filter((p) => p.id !== purchaceId);
        }

        // Dodatkowo możesz sprawdzić komunikat w konsoli
        console.log(response.data.message);
      } catch (error) {
        console.error("Error updating purchace status:", error);
        this.statusMessage = "Wystąpił błąd podczas aktualizacji statusu."; // Komunikat błędu
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      const day = date.getDate();
      const month = date.getMonth() + 1;
      const year = date.getFullYear();
      return `${day}.${month}.${year}`;
    },
    formatPaymentStatus(status) {
      return status === "completed" ? "Opłacono" : status;
    },
    async fetchQrCodePurchaces(purchaceId) {
      try {
        const userId = localStorage.getItem("userId");
        const token = localStorage.getItem("token");
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        if (!userId) {
          throw new Error("User ID not found in localStorage.");
        }

        const response = await axios.post(
          "http://localhost:8001/user/qr-codes-purchaces",
          {
            userId: userId,
            purchaceId: purchaceId,
          }
        );

        // Szukamy odpowiedniego zakupionego przedmiotu
        const purchace = this.purchaces.find((p) => p.id === purchaceId);
        if (purchace) {
          // Generujemy kody QR tylko dla tego konkretnego zakupionego przedmiotu
          purchace.qrCodes = await Promise.all(
            response.data.map(async (qrCode) => {
              const qrImage = await QRCode.toDataURL(qrCode.code, {
                width: 150,
                height: 150,
              });
              return { ...qrCode, qrImage };
            })
          );
          console.log(purchace.qrCodes); // Sprawdzanie wygenerowanych kodów QR
        }
      } catch (error) {
        console.error("Error fetching QR code data:", error);
      }
    },
  },
  mounted() {
    this.access();
    this.activePurchaces();

    // Ustawienie intervalu na 1 sekundę
    this.intervalId = setInterval(() => {
      // Przykład z użyciem pierwszego purchaceId
      if (this.purchaces.length > 0) {
        this.updatePurchaceStatus(this.purchaces[0].id);
      }
    }, 60000);
  },
  beforeDestroy() {
    // Usuwanie intervalu przed odmontowaniem komponentu
    if (this.intervalId) {
      clearInterval(this.intervalId);
    }
  },
};
</script>

<style lang="scss" scoped>
.none-text {
  padding-top: calc(4rem + 50px);
  h2 {
    font-size: 24px;
    color: var(--white);
    text-align: center;
    font-weight: 600;
  }
  &.active {
    display: none;
  }
}
.top-bar {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 999;
  background-color: var(--light-black);
  .top-bar-content {
    width: 95%;
    margin-left: auto;
    margin-right: auto;
    display: flex;
    justify-content: space-between;
    .top-bar-item-active {
      width: 50%;
      border-bottom: 2px solid var(--orange);
      p {
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-size: 20px;
        color: var(--orange);
        text-align: center;
      }
    }
    .top-bar-item {
      width: 50%;
      p {
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-size: 20px;
        color: var(--white);
        text-align: center;
      }
    }
  }
}

.scroll {
  padding-bottom: 6rem;
  &.active {
    display: flex;
  }
  .table {
    padding-top: calc(4rem + 50px);
    width: 40%;
    margin-left: auto;
    margin-right: auto;
    display: flex;
    justify-content: space-between;
    .table-col {
      p {
        font-size: 16px;
        color: var(--white);
        font-weight: 400;
      }
    }
  }

  .service {
    width: 40%;
    margin-left: auto;
    margin-right: auto;
    .service-item {
      margin-top: 30px;
      .service-item-top {
        display: flex;
        justify-content: space-between;
        .service-col-left {
          display: flex;
          position: relative;
          right: 40px;
          p {
            font-size: 16px;
            color: var(--white);
            font-weight: 600;
          }
          img {
            margin-right: 1rem;
          }
        }
        .service-col-center {
          display: flex;
          p {
            font-size: 16px;
            color: var(--white);
            font-weight: 600;
          }
          img {
            margin-right: 1rem;
          }
        }
        .service-col-right {
          display: flex;
          position: relative;
          left: 40px;
          p {
            font-size: 16px;
            color: var(--white);
            font-weight: 600;
          }
          img {
            margin-left: 1rem;
          }
        }
      }
      .service-item-bottom {
        .qr-code {
          display: none;
          &.active {
            display: block;
          }
          .qr-code-top {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            p {
              color: var(--white);
              font-size: 16px;
              font-weight: 400;
            }
          }
          .qr-code-status {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            p {
              color: var(--white);
              font-size: 16px;
              font-weight: 400;
            }
          }
          .qr-code-flex {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;

            margin-bottom: 30px;

            .qr-code-img {
              margin-right: 30px;
              img {
                background-color: var(--white);
              }
            }
            .qr-code-info {
              display: flex;
              flex-direction: column;
              justify-content: space-around;
              .qr-code-info-top {
                p {
                  color: var(--white);
                  font-size: 20px;
                  font-weight: 600;
                  margin-bottom: 1rem;
                }
                h2 {
                  color: var(--white);
                  font-size: 16px;
                  font-weight: 400;
                  margin-bottom: 1rem;
                }
              }
              .qr-code-info-bottom {
                p {
                  font-size: 16px;
                  color: var(--white);
                  font-weight: 400;
                }
              }
            }
          }
          .qr-code-button {
            .qr-code-btn:first-child {
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
              p {
                margin-left: 2rem;
                color: var(--white);
                font-size: 16px;
              }
              .qr-code-btn-icons {
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
      }
    }
  }
}

@media screen and (max-width: 1024px) {
  .scroll {
    padding-bottom: 6rem;
    .table {
      width: 100%;
    }
    .service {
      width: 100%;
      .service-item {
        .service-item-top {
          .service-col-left {
            right: auto;
            img {
              display: none;
            }
          }
          .service-col-right {
            left: auto;
            img {
              display: none;
            }
          }
        }
        .service-item-bottom {
          .qr-code {
            .qr-code-flex {
              display: flex;
              justify-content: space-between;
              .qr-code-img {
                margin-right: 0;
                img {
                  width: 100px;
                }
              }
              .qr-code-info {
                width: 50%;
                .qr-code-info-top {
                  p {
                    font-size: 16px;
                  }
                }
              }
            }
            .qr-code-button {
              .qr-code-btn:first-child {
                p {
                  font-size: 14px;
                  margin-left: 1rem;
                }
                .qr-code-btn-icons {
                  margin-right: 1rem;
                }
              }
            }
          }
        }
      }
    }
  }
}
</style>
