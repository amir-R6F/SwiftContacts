<template>
    <div>
        <b-overlay :show="isLoading" rounded="lg">
            <alert-component></alert-component>

            <b-button-toolbar class="justify-content-center my-2">
                <b-btn @click="$refs['insert'].show()" size="sm" variant="success">
                    <b-icon icon="journal-plus"></b-icon>
                </b-btn>
            </b-button-toolbar>

            <b-modal ref="insert" hide-footer class="dark_side" hide-header>
                <insert-contact :options="options"></insert-contact>
            </b-modal>

            <b-modal ref="update" hide-footer>
                <insert-contact :data="form" :options="options"></insert-contact>
            </b-modal>

            <b-modal ref="info" hide-footer hide-header>
                <b-table stacked :items="info"></b-table>
                <h3>Options</h3>
                <b-table stacked :items="optionInfo"></b-table>
            </b-modal>


            <div class="row justify-content-center bg-Milk">
                <div v-for="(data, index) in contacts" :key="index" class="mx-1 my-1 col-sm-12 col-md-4 box bg-white">
                    <b-row>
                        <b-col cols="3">{{ $helper.cutLength(data.name, 6) }}</b-col>
                        <b-col cols="4">{{ $helper.cutLength(data.last_name, 6) }}</b-col>
                        <b-col cols="5">
                            <b-button variant="none" size="sm" @click="showUpdateModal(data)">
                                <b-icon icon="pencil-square" variant="warning"></b-icon>
                            </b-button>

                            <b-button variant="none" size="sm">
                                <b-icon icon="info-circle" variant="primary" @click="showInfo(data)"></b-icon>
                            </b-button>

                            <b-button variant="none" size="sm" @click="mydelete(data)">
                                <b-icon icon="x-circle" variant="danger"></b-icon>
                            </b-button>
                        </b-col>
                    </b-row>
                </div>
            </div>
        </b-overlay>

    </div>
</template>

<script>
import event from "../event";

export default {
    name: "ContactComponent",
    data() {
        return {
            form: {},
            contacts: null,
            info: [],
            optionInfo: [],
            options: null,
            isLoading: false
        }
    },
    methods: {
        getContacts() {
            this.isLoading = true
            axios.get("contactList").then(res => {
                this.contacts = res.data.contacts;
                this.isLoading = false;
            }).catch(e => {
                console.log(e)
            })
        },
        getContactsOptions() {
            this.isLoading = true
            axios.get("contactOptions").then(res => {
                this.options = res.data.contactOptions;
                this.isLoading = false
            }).catch(e => {
                console.log(e)
            })
        },
        showInfo(data) {
            this.info = [];
            this.optionInfo = [];
            for (let i in data.option_value)
                this.$helper.information_modal(this.optionInfo, data.option_value[i], ["id", "contact_id", "created_at", "updated_at"]);

            this.$helper.information_modal(this.info, data, ["id", "user_id", "option_value", "created_at", "updated_at"]);
            this.$refs['info'].show();
        },
        mydelete(data) {
            let result;
            (async () => {
                result = await this.$helper.mydelete('/delete', data)
                this.$helper.deleteFromRepository(result.id, this.contacts);
                event.$emit('showAlert', {state: 1, message: result.message});
            })()
        },
        checkTheInput({dirty, validated, valid = null}) {
            return dirty || validated ? valid : null;
        },
        showUpdateModal(data) {
            this.form = data
            this.$refs['update'].show();
        },

    },
    created() {
        this.getContactsOptions();
        this.getContacts();

        event.$on('pushNewdata', (data) => {
            this.contacts.push(data);
            this.$refs['insert'].hide();
        })

        event.$on('updateData', (data) => {
            for (let i = 0; i < this.contacts.length; i++) {
                if (this.contacts[i].id === data.id) {
                    this.contacts[i] = data;
                    this.form = null
                    this.$refs['update'].hide();
                    event.$emit('showAlert', {state: 1, message: data.message});
                }
            }
        })

    },
    updated() {
    },
    mounted() {
    }

}
</script>

<style scoped>
.table {
    border: 1px solid white;
    border-radius: 15px;
    background-color: white;
}

.dark_side {
    background-color: black;
}

input {
    margin-top: 20px;
}

.box {
    padding: 10px;
    border-radius: 10px;
}


</style>
