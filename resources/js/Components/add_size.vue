<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-heading">Add Width</div>
                    <div class="modal-body">
                        <!-- <MeasurementForm :error="error" :form="form"/> -->
                        <div class="row">
                <div class="col col-6">
                    <div class="form-group">
                        <label>Width Size</label>
                        <input class="form-control"
                               type="text"
                              >
                        
                    </div>
                </div>
                <div class="col col-4">
                    <div class="form-group">
                        <label>
                            Is Active
                        </label>
                        <!-- <select class="form-control"
                                v-model="form.active">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <error-text :error="error.active"></error-text> -->
                    </div>
                </div>
            </div>
                    </div>
                    <div class="panel-footer">
                        <spinner v-if="isProcessing"></spinner>
                        <div class="btn-group" v-else>
                            <button :disabled="isProcessing" @click="save" class="btn success">
                                Save
                            </button>
                            <button :disabled="isProcessing" @click="closeModal" class="btn error">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script type="text/javascript">
    // import {form} from "../../lib/mixins";
    // import ErrorText from "../form/ErrorText.vue";
    // import Spinner from "../loading/Spinner.vue";
    // import MeasurementForm from "../form/MeasurementForm";

    export default {
        components: {
            // MeasurementForm,
            // ErrorText,
            // Spinner,
        },
        // mixins: [form],
        data() {
            return {
                store: `/api/sizes`,
                method: "POST",
                message: `You have successfully added Size!`,
            };
        },
        methods: {
            closeModal() {
                this.$emit("close");
            },
            save() {
                this.submit(data => {
                    this.success();
                    this.closeModal();
                });
            }
        }
    };
</script>