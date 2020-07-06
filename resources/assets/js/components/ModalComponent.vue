<template>
    <div
        class="modal fade"
        :id="id"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalComponent"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            :class="size ? `modal-${size}` : null"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header" v-if="title">
                    <h5 class="modal-title" id="modalTitle" data-private="lipsum">{{ title }}</h5>
                    <button
                        v-if="!noclose"
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <button
                        v-if="!title && !noclose"
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalComponent",
    props: ["id", "title", "visible", "size", "noclose"],
    //sizes: 'sm', null, 'lg'
    mounted() {
        // sets up a listener that triggers the "@close" event when the user closes the modal
        const self = this;
        $("#" + this.id).on("hidden.bs.modal", function() {
            self.$emit("close");
        });
    },
    watch: {
        visible() {
            $("#" + this.id).modal(this.visible ? "show" : "hide");
        },
    },
    methods: {
        closeModal() {
            $("#" + this.id).modal("hide");
        },
    },
};
</script>

<style scoped></style>
