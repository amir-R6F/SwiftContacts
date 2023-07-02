<template>
    <div>
        <b-card class="line">
            <b-card-title class="line p-3">Add your Contact</b-card-title>

            <b-card-body>
                <validation-observer ref="observer" v-slot="{ handleSubmit }">
                    <b-form @submit.stop.prevent="handleSubmit(addContact)">
                        <div class="my-3" v-for="(obj,key) in options.static.value">
                            <validation-provider
                                :name="options.static.fields_name[key]"
                                :rules="options.static.rules[key]"
                                v-slot="validationContext">

                                <b-form-group>
                                    <b-form-input
                                        v-model="forms.static_value[key]"
                                        :state="getValidationState(validationContext)"
                                        :aria-describedby="'input-'+key+'-live-feedback'"
                                        :placeholder="options.static.fields_name[key]"
                                    ></b-form-input>

                                    <b-form-invalid-feedback :id="'input-'+key+'-live-feedback'">{{
                                            validationContext.errors[0]
                                        }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </validation-provider>
                        </div>

                        <label for="" class="my-1 top-line">Optional Item: </label>

                        <v-select :options="options.dynamic" :reduce="op => op"
                                  label="title"
                                  class="my-1"
                                  v-model="select"></v-select>

                        <div v-if="select"  class="my-1">
                            <div v-for="(op, index) in select.fields" :key="index">
                                <b-btn variant="outline-primary my-1" size="sm" @click="addInput(op)" v-text="op.label"></b-btn>
                            </div>
                        </div>

                        <div v-for="(object,i) in forms.option_value" class="my-3">

                            <label v-text="object.field_name +':'"></label>
                            <ValidationProvider
                                v-slot="validationContext"
                                :name="object.field_name"
                                :rules="object.rule"
                            >

                                <b-input-group>
                                    <b-input type="text" v-if="object.type === 'other'" v-model="object.field_name"
                                             placeholder="type your filed name"></b-input>

                                    <b-input
                                        v-model="object.value"
                                        :state="getValidationState(validationContext)"
                                        :aria-describedby="'input-optional-'+i+'-live-feedback'"
                                    ></b-input>
                                    <b-input-group-append>
                                        <b-icon variant="danger" @click="mySlice(i)" class="displayMinus"
                                                icon="file-minus"
                                                v-b-tooltip.hover title="Delete Field"></b-icon>
                                    </b-input-group-append>
                                </b-input-group>

                                <b-form-invalid-feedback :id="'input-optional-'+i+'-live-feedback'">
                                    {{ validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </ValidationProvider>
                        </div>

                        <b-btn class="btn btn-success" type="submit">Add</b-btn>
                    </b-form>
                </validation-observer>
            </b-card-body>
        </b-card>


    </div>
</template>

<script>


import event from "../event";

export default {
    props: ['data', 'options'],
    name: "InsertComponent",
    data() {
        return {
            forms: {
                id: 0,
                static_value: this.options.static.value,
                option_value: [],
            },
            select: null,
        }
    },
    methods: {
        mySlice(i){
            this.forms.option_value.splice(i, 1);
        },
        addInput(data) {
            let option = {};
            for (let i in data.option) {
                option[i] = data.option[i]
            }
            this.forms.option_value.push(option);
        },
        addContact() {
            if (this.data) {
                this.forms.id = this.data.id;
                (async () => {
                    let result = await this.$helper.update('/insert', this.forms) // update
                    event.$emit('updateData', result);
                    // this.resetForm();
                })()
            } else {
                (async () => {
                    let result = await this.$helper.store('/insert', this.forms);
                    event.$emit('pushNewdata', result)
                    // this.resetForm();
                })();
            }

        },
        resetForm() {
            for (let key in this.forms.static_value)
                this.forms.static_value[key] = null;
            this.forms.option_value = [];
        },
        getValidationState({dirty, validated, valid = null}) {
            return dirty || validated ? valid : null;
        },
    },
    created() {
        if (this.data) {
            this.resetForm();
            for (let key in this.forms.static_value) {
                this.forms.static_value[key] = this.data[key];
            }
            this.forms.option_value = this.data.option_value;
        } else {
            this.resetForm();
        }
    }
}
</script>

<style scoped>
.dark_side {
    background-color: black;
}

.line {
    border-bottom: 1px solid #f6993f;
}

.top-line {
    border-top: 1px solid #f6993f;
}

.displayMinus{
    position: absolute;
    margin-top: 0.7em;
    right: -2vw;
    cursor: pointer;
}

</style>
