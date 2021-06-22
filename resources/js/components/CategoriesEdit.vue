<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-12">
        <div v-if="loading" class="text-center">Loading...</div>
        <div v-else-if="isValidId">
          <div class="mb-3">
            <form v-on:submit.prevent="submitForm">
              <label for="name" class="form-label">Name:</label>
              <input
                type="text"
                v-model="form.name"
                name="name"
                class="form-control"
                id="name"
                placeholder="Category Name"
                autocomplete="off"
              />
              <hr />
              <p class="form-label">Photo:</p>
              <div :class="'api' + (form.photo ? ' api--opacity' : '')">
                <img
                  v-if="form.photo"
                  :src="form.photo"
                  :alt="form.name"
                  style="width: 100px; height: 100px"
                />
                <div class="api__overlay">
                  <div class="api-file">
                    <label class="api-file__label">
                      <input
                        type="file"
                        accept="image/*"
                        name="photo"
                        @change="onHandleUpload($event)"
                        class="api-file__input"
                      />
                      <span class="api-file__btn">
                        <span class="api-file__text">Upload</span>
                      </span>
                    </label>
                  </div>
                </div>
              </div>

              <hr />

              <button
                class="btn btn-primary"
                type="button"
                :disabled="isSubmitted"
                @click="submitForm"
              >
                <span
                  v-if="isSubmitted"
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">{{
                  isSubmitted ? 'Loading' : 'Submit'
                }}</span>
              </button>
            </form>
          </div>
        </div>
        <div v-else class="text-center">404 not found!</div>
      </div>
    </div>
  </div>
</template>

<script>
import { onSingleFileUpload, uploadProgress } from '../utils';

export default {
  name: 'CategoriesEdit',
  props: ['id'],
  data: function () {
    return {
      loading: true, // Before the form display on the screen, just show the loading text
      isValidId: false, // Check if the following id is a valid category id
      isSubmitted: false, // To check whether the form is in the submitted
      form: {
        name: '',
        photo: ''
      },
      selectedFile: null
    };
  },
  mounted() {
    this.loadInitialData();
  },
  methods: {
    loadInitialData: function () {
      const self = this;
      const { id } = self;

      axios
        .get(`/api/categories/${id}`)
        .then(function (response) {
          self.loading = false;
          self.isValidId = true;
          self.form.name = response.data.data.name;
          self.form.photo = response.data.data.photo;
        })
        .catch(function (_) {
          self.loading = false;
          self.isValidId = false;
        });
    },
      onHandleUpload: function (event) {
          const file = onSingleFileUpload(event);
          if (file) {
              this.selectedFile = file;
          }
      },
    submitForm: function () {
      const self = this;
      const { id } = self;
      // Check if the string is not empty
      if (typeof self.form.name === 'string' && self.form.name.length > 0) {
        self.isSubmitted = true;

        const formData = new FormData();

        // Append formData fields
        formData.append('_method', 'PUT');
        formData.append('name', self.form.name);
        if (self.selectedFile) {
          formData.append('photo', self.selectedFile);
        }

        axios
          .post(`/api/categories/${id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: uploadProgress
          })
          .then(function (response) {
            console.log('response', response.data);
            self.isSubmitted = false;
            self.form.name = response.data.data.name;
            self.form.photo = response.data.data.photo;
            alert('Data is successfully updated');
          })
          .catch(function (_) {
            self.isSubmitted = false;
            alert('Oops! Something went wrong during posting the form. 🥺');
          });
      } else {
        alert(
          `Sorry We can't submit the form. The category 'name' is required. 🥺`
        );
      }
    }
  }
};
</script>
