<template>
    <modal-component id="timeout-modal" :visible="showModal" noclose="true" @close="showModal = true">
        <div>
            <p class="text-center">We haven't heard from you in a while!</p>
            <p class="text-center">You will be automatically logged out in:</p>
            <p class="text-center">
                <span class="text-danger" style="font-size: 1.5em;">{{ this.remainingTime }}</span>
                seconds
            </p>
            <div class="d-flex flex-column w-100 justify-content-between align-items-center py-3">
                <button
                    class="btn btn-sm btn-primary font-weight-bold text-uppercase text-white"
                    @click="resetTimeout()"
                >
                    <span>I'm still here!</span>
                </button>
            </div>
        </div>
    </modal-component>
</template>

<script>
import ModalComponent from "./ModalComponent";

const timeToAlert = 31;

export default {
    name: "TimeoutDialog",
    props: [],
    components: {
        ModalComponent,
    },
    data() {
        return {
            showModal: false,
            remainingTime: undefined,
            timer: setInterval(() => {
                if (this.remainingTime === undefined) return;
                    
                this.remainingTime = this.remainingTime <= 0 ? 0 : this.remainingTime - 1;

                if (this.remainingTime <= 0) {
                    // session should be expired at this point
                    // redirect to /login
                    setTimeout(() => {
                        window.location.replace("/login");
                    }, 1500);
                    return;
                }

                if (this.remainingTime <= timeToAlert) {
                    if (!this.showModal) {
                        // another check to make sure if we still need to show modal
                        this.checkTimeout(remainingTime => {
                            if (remainingTime <= timeToAlert) {
                                this.showModal = true;
                            }
                        });
                        return;
                    } else {
                        // modal is already shown, but maybe timeout reset in another tab or window
                        // check again every 5 seconds
                        if (this.remainingTime % 5 === 1) {
                            this.checkTimeout(remainingTime => {
                                if (remainingTime > timeToAlert) {
                                    this.showModal = false;
                                }
                            });
                        }
                    }
                }
            }, 1000)
        };
    },
    mounted() {
        this.checkTimeout();
    },
    methods: {
        checkTimeout(callback) {
            axios
                .get("/idle-timeout-alert/check")
                .then(response => {
                    this.remainingTime = response.data;
                    if (callback) {
                        callback(response.data);
                    }
                })
                .catch(e => {
                    window.location.replace("/login");
                });
        },
        resetTimeout() {
            axios
                .post("/idle-timeout-alert/ping")
                .then(response => {
                    this.showModal = false;
                    this.remainingTime = response.data;
                })
                .catch(e => {
                    window.location.replace("/login");
                });
        },
    },
};
</script>
