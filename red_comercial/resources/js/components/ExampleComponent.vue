<template>
  <div class="container">
    <div>
      <h2>Search and add a pin</h2>
      <label>
        <gmap-autocomplete @place_changed="setPlace"></gmap-autocomplete>
        <button @click="addMarker">Add</button>
      </label>
      <br />
    </div>
    <br />
    <gmap-map id="g-map" :center="center" :zoom="12" style="width:100%;  height: 400px;">
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        @click="center=m.position"
      ></gmap-marker>
    </gmap-map>
  </div>
</template>

<script>
export default {
  name: "GoogleMap",
  data() {
    return {
      // default to Montreal to keep it simple
      // change this to whatever makes sense
      micrositios: false,
      loaded: false,
      center: { lat: 22.7317819, lng: -98.9766827 },
      markers: [],
      places: [],
      currentPlace: null,
    };
  },

  mounted() {
    this.listMicrositios();
    this.geolocate();
  },

  methods: {
    // receives a place object via the autocomplete component
    initMarkers(lat, long) {
      const marker = {
        lat: parseFloat(lat),
        lng: parseFloat(long),
      };

      this.markers.push({ position: marker });
    },
    listMicrositios() {
      var that = this;
      this.axios.get("/api/micrositios").then(function (response) {
        that.micrositios = response.data;
        that.micrositios.forEach(function (micrositio) {
          that.initMarkers(micrositio.latitud, micrositio.longitud);
        });
        that.loaded = true;
      });
    },
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng(),
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },
    geolocate: function () {
      navigator.geolocation.getCurrentPosition((position) => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
      });
    },
  },
};
</script>