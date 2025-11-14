<template>
  <v-card
    class="feature-card rounded-lg border"
    elevation="1"
    variant="outlined"
  >
    <v-card-text class="text-start pa-6">
      <div
        class="icon-wrapper mb-4 d-inline-flex align-center justify-center rounded-lg"
        :style="{ backgroundColor: iconBgColor }"
        style="width: 60px; height: 60px"
      >
        <v-icon :icon="icon" size="38" :color="iconColor"></v-icon>
      </div>
      <h3 class="text-h6 font-weight-bold mb-3">{{ title }}</h3>
      <p class="text-body-3 text-grey-darken-2">{{ description }}</p>
    </v-card-text>
  </v-card>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    default: "mdi-checkbox-marked-circle-outline",
  },
  iconColor: {
    type: String,
    default: "#5c94fa",
  },
  iconBgColor: {
    type: String,
    default: "#b6cefc",
  },
});
</script>

<style scoped>
.feature-card {
  transition: all 0.3s ease;
  height: 100%;
}

.feature-card:hover {
  border-color: transparent !important;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
  transform: translateY(-2px);
}
</style>
