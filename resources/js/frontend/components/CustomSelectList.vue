<template>
    <div>
        <input type="hidden" :name="inputName" :value="finalValue" />
        <div>
            <div>
                <label v-for="id in selected" class="btn btn-success btn-sm" style="margin-right: 4px">
                    {{getItemName(id)}}
                    <i @click="removeItem(id)" class="fa fa-fw fa-window-close"></i>
                </label>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select v-model="currentSelected" class="form-control">
                        <option v-for="item in list" :value="item.id">{{item.title}}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <a @click="addItem" href="javascript:void(0)" class="btn btn-primary">
                        <i class="fa fa-fw fa-plus"></i> Add
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            list: Array,
            inputName: String,
            initSelect: Array
        },
        data: function() {
            return {
                selected: [],
                currentSelected: 0
            }
        },
        mounted() {
            if (this.initSelect) {
                this.selected = this.initSelect;
            }
            if (this.list.length > 0) {
                this.currentSelected = this.list[0].id;
            }
        },
        methods: {
            getItemName: function (id) {
                return this.list.find((item) => {
                    return item.id === id;
                }).title;
            }    ,
            removeItem: function (id) {
                const index = this.selected.indexOf(id);
                this.selected.splice(index, 1);
            },
            addItem: function () {
                const index = this.selected.indexOf(this.currentSelected);
                if (index === -1) {
                    this.selected.push(this.currentSelected);
                }
            }
        },
        computed: {
            finalValue: function () {
                return this.selected.join(',')
            }
        }
    }
</script>
