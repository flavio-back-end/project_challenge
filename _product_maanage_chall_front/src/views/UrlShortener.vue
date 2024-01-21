<template>
  <div class="container mt-5">
    <h1 class="mb-4">URL Shortener</h1>

    <!-- Input form -->
    <div class="mb-3">
      <label for="originalUrl" class="form-label">Original URL:</label>
      <div class="input-group">
        <input
          v-model="originalUrl"
          type="text"
          id="originalUrl"
          class="form-control"
          placeholder="Enter your URL"
        />
        <button @click="shortenUrl" class="btn btn-primary">Shorten</button>
      </div>
    </div>

    <!-- Display shortened URL -->
    <div v-if="shortenedUrl" class="mb-3">
      <p class="fw-bold">Shortened URL:</p>
      <a :href="shortenedUrl" target="_blank" class="text-primary">{{
        shortenedUrl
      }}</a>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      originalUrl: "",
      shortenedUrl: null,
    };
  },
  methods: {
    shortenUrl() {
      // Assuming you have the access token stored in localStorage
      const accessToken = localStorage.getItem("access_token");

      // Make an API request to your Laravel backend with the access token
      axios
        .post(
          "http://127.0.0.1:8000/api/shorten",
          { original_url: this.originalUrl },
          {
            headers: {
              Authorization: `Bearer ${accessToken}`,
            },
          }
        )
        .then((response) => {
          this.shortenedUrl = response.data.short_url;
        })
        .catch((error) => {
          console.error("Error shortening URL:", error);
        });
    },
  },
};
</script>
