export default {
  props: {
    urlKey: {
      required: true,
      type: String,
    },
    placeholder: {
      required: false,
      type: String,
    },
  },

  methods: {
    submit(value) {
      this.$parent.$emit('setFilter', {
        urlKey: this.urlKey,
        value: value,
      });
    },
  },
}
