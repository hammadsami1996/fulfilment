import {byMethod} from './api'
import {objectToFormData} from './helpers'

export const form = {
        data() {
            return {
                form: {},
                error: {},
                isProcessing: false,
                show: false
            }
        },
        computed: {
            mode() {
                return this.$route.meta.mode

            },
            isEdit() {
                return this.mode === 'edit'
            }
        },
        methods: {
            errors(key) {
                return this.error[key] ? 'error-bg' : ''
            },
            // openLoading() {
            //     this.$vs.loading({type: 'radius',});
            // },
            // closeLoading() {
            //     setTimeout(() => {
            //         this.$vs.loading.close()
            //     }, 500);
            // },
            clearErrors() {
                this.error = {}
            }
            ,
            handleError(error) {
                // this.closeLoading();
                if (error.response.status === 422) {
                    this.error = error.response.data.errors
                }
            },
            handleErrors(error) {
                if (error != undefined && error != null) {
                    // error.response?.status === 422 &&
                    if (error.response?.data.errors) {
                        this.error = Object.keys(error.response.data.errors).map(key => error.response.data.errors[key][0])
                    } else {
                        if (error.response?.data.message) {
                            this.error = error.response.data.message
                            this.notify(error.response.data.message, "danger");
                        }
                    }
                }
            },
            destroy(url, cb, data) {
                this.clearErrors();
                // this.openLoading();
                byMethod("DELETE", url, data).then(function ({data}) {
                    // if (data.errors){
                    //     this.handleErrors(data.message)
                    // }
                    this.$toast.open({
                        position: 'top-right',
                        message: 'Delete Successfully!',
                        type: 'success',
                        duration: 3000
                    });

                    if (data.deleted) {
                        cb(data)
                    }
                }).catch(error => {
                    this.handleError(error)
                    this.handleErrors(error)
                })
            }
            ,
            submit(file = '', cb) {
                this.clearErrors();
                // this.openLoading();
                if (file == 'file') {
                    this.form = objectToFormData(this.form);
                }
                byMethod(this.method, this.store, this.form).then(function ({data}) {
                    if (data.saved) {
                        cb(data);
                    }
                    this.$toast.open({
                        position: 'top-right',
                        message: this.mode === 'edit' ? 'Update Successfully' : 'Create Successfully',
                        type: 'success',
                        duration: 3000
                    });
                }).catch(error => {
                    // this.handleError(error)
                    this.handleErrors(error)
                })
            },

            submitMultipartForm(form, cb) {
                this.clearErrors();
                // this.openLoading();
                byMethod(this.method, this.store, objectToFormData(this.form)).then(function ({data}) {
                    if (data.saved) {
                        cb(data);
                        return true;
                    }
                    return false;
                }).catch(error => {
                    this.handleError(error);
                    return false;
                })
            },
            submitMultipartFormCustom(method, store, form, cb) {
                this.clearErrors();
                // this.openLoading();
                byMethod(method, store, objectToFormData(form)).then(function ({data}) {
                    if (data.saved) {
                        cb(data);
                        return true;
                    }
                    return false;
                }).catch(error => {
                    this.handleError(error);
                    return false;
                })
            }

        }
    }
;
