<template>
    <div class="form-inline my-3 my-lg-0 search_box_wrapper">
        <input v-model="searchText"
               class="form-control mr-sm-2"
               type="search"
               placeholder="Client Search"
               @focus="textBoxFocus"
               @blur="textBoxBlur"
               aria-label="Search Clients">
        <ul v-if="isShowResult" class="search_result_wrapper">
            <li v-for="client in clientSearchResult">
                <a @click="setClient(client.id)" href="javascript:void(0)" v-html="displayClientTextHighlight(client)"></a>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapState, mapMutations, mapActions} from 'vuex';
    export default {
        data() {
            return {
                searchText: '',
                isFocus: false
            }
        },
        mounted() {
            this.loadInitDashboard()
        },
        computed: {
            ...mapState('userDashboard', ['clients']),
            clientSearchResult() {
                if (this.searchText.length === 0) {
                    return [];
                }
                const lowerSearch = this.searchText.toLowerCase().trim();
                const searchResult = this.clients.filter((client) => {
                    return client.first_name.toLowerCase().includes(lowerSearch) || client.last_name.toLowerCase().includes(lowerSearch)
                })
                return searchResult.slice(0, 5);
            },
            isShowResult() {
                return this.clientSearchResult.length > 0 && this.isFocus
            }
        },
        methods: {
            ...mapMutations('userDashboard', ['setSelectedClient', 'setSelectedTestId']),
            ...mapActions('userDashboard', ['loadInitDashboard']),
            textBoxFocus() {
                this.isFocus = true;
            },
            textBoxBlur() {
                setTimeout(() => {
                    this.isFocus = false;
                }, 100);
            },
            displayClientTextHighlight(client) {
                const fullName = `${client.first_name} ${client.last_name}`;
                const regex = new RegExp(`(${this.searchText})`, 'gi');
                return fullName.replace(regex, '<mark>$1</mark>');
            },
            setClient(id) {
                this.setSelectedTestId(0);
                this.setSelectedClient(id);
            }
        }
    }
</script>
