<template>
  <v-app>
    <v-app-bar
      dark
      class="custom-app-bar"
      color="transparent"
      elevation="2"
      floating
    >
      <v-container
        class="d-flex align-center justify-space-between fill-height"
      >
        <!-- Left side -->
        <div class="d-flex align-center">
          <v-icon color="blue" size="48" class="mr-2 text-blue text--darken-4">
            mdi-school-outline
          </v-icon>
          <v-toolbar-title class="text-h5 font-weight-bold">
            EduInfra
          </v-toolbar-title>
        </div>

        <!-- Right side -->
        <div class="d-flex align-center ga-2">
          <v-btn
            variant="text"
            size="x-large"
            rounded="lg"
            class="login-btn text-none"
            to="/login"
          >
            Log Masuk
          </v-btn>

          <v-btn
            variant="outlined"
            color="primary"
            size="x-large"
            rounded="lg"
            class="text-none"
            to="/register"
          >
            Daftar
          </v-btn>
        </div>
      </v-container>
    </v-app-bar>

    <!-- 🏠 Main Landing Section -->
    <v-main>
      <div justify="center">
        <v-row>
          <v-col cols="12" class="text-center">
            <h1 class="custom-heading">Sekolah Rendah Pintar</h1>
            <div class="gradient-box"></div>
            <div class="text-grey-darken-3 mt-4 text-h5">
              Platform digital yang komprehensif untuk sekolah rendah Malaysia
              bagi mengurus operasi, <br />
              rekod akademik dan komunikasi dengan cekap.
            </div>
          </v-col>
        </v-row>
      </div>

      <!-- Everything You Need Section -->
      <div class="mt-16">
        <v-row justify="center">
          <v-col cols="12" md="8" class="text-center">
            <h1 class="text-h3 font-weight-bold mb-4">
              Semua Dalam Satu Tempat
            </h1>
            <p class="text-h6 text-grey-darken-2 mb-10">
              Urus semua tugasan sekolah dengan lebih mudah, cepat dan telus di
              satu platform.
            </p>

            <!-- Features Grid -->
            <v-container>
              <v-row>
                <v-col
                  v-for="(feature, index) in features"
                  :key="index"
                  cols="12"
                  sm="6"
                  md="6"
                  xl="4"
                  class="d-flex"
                >
                  <FeatureCard
                    :title="feature.title"
                    :description="feature.description"
                    :icon="feature.icon"
                  />
                </v-col>
              </v-row>
            </v-container>
          </v-col>
        </v-row>
      </div>
    </v-main>
  </v-app>
</template>

<script setup>
import FeatureCard from "@/components/FeatureCard.vue";

const features = [
  {
    title: "Akses Pelbagai Peranan",
    description:
      "Papan analisis untuk guru, ibu bapa, pengetua, kerani dan pengawal keselamatan.",
    icon: "mdi-account-multiple-outline",
  },
  {
    title: "Notifikasi",
    description:
      "Makluman segera untuk pengumuman, janji temu dan kemas kini penting.",
    icon: "mdi-bell-outline",
  },
  {
    title: "Pengurusan Kehadiran",
    description:
      "Rekod kehadiran digital dengan kemas kini masa nyata dan laporan automatik.",
    icon: "mdi-calendar-check-outline",
  },
  {
    title: "Selamat & Boleh Dipercayai",
    description:
      "Akses berdasarkan peranan bagi melindungi privasi dan keselamatan data.",
    icon: "mdi-shield-outline",
  },
  {
    title: "Analisis Prestasi",
    description:
      "Pandangan menyeluruh mengenai kemajuan murid dan prestasi kelas.",
    icon: "mdi-chart-bar",
  },
  {
    title: "Rekod Akademik",
    description:
      "Pusat simpanan data murid, markah dan rekod disiplin secara teratur.",
    icon: "mdi-school-outline",
  },
];
</script>

<style scoped>
.custom-app-bar {
  height: 80px !important;
  min-height: 80px !important;
  background: transparent !important;
  backdrop-filter: none !important;
}

.custom-app-bar :deep(.v-toolbar__content) {
  height: 80px !important;
  padding: 0;
  background: transparent !important;
}
.v-application {
  overflow-y: visible !important;
}

.v-main {
  margin-top: 120px;
}

.login-btn:hover {
  background-color: #4caf50 !important;
  color: white !important;
}

:deep(.v-container) {
  height: 100%;
}

:deep(.v-toolbar-title) {
  line-height: normal;
}

:deep(h1.text-h3),
:deep(.custom-heading) {
  font-family: "Poppins", sans-serif !important;
  font-size: 3rem !important;
  font-weight: 500 !important;
}

.custom-app-bar :deep(.v-toolbar) {
  border: none !important;
  box-shadow: none !important;
}

.gradient-box {
  display: inline-block;
  background: linear-gradient(
    135deg,
    hsl(217 91% 60%) 0%,
    hsl(142 71% 59%) 100%
  );
  width: 60%;
  height: 30px;
  border-radius: 4px;
  margin-top: 8px;
}
</style>
