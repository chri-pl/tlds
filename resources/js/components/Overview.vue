<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <a class="navbar-brand" href="/">TLDs Übersicht</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href @click.prevent="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="clearfix">
            <Search v-on:filters-changed="changeFilters" />
            <Pagination 
                :page="page"
                :perPage="perPage"
                :totalRows="totalRows"
                :totalPages="totalPages"
                v-on:page-changed="changePage"
                v-on:per-page-changed="changePerPage"
            />
        </div>
        <br>
        <Datatable :rows="rows" />
        <br>
        <div class="clearfix">
            <Pagination 
                :page="page"
                :perPage="perPage"
                :totalRows="totalRows"
                :totalPages="totalPages"
                v-on:page-changed="changePage"
                v-on:per-page-changed="changePerPage"
            />
        </div>
    </div>
</template>

<script>
    
    import Search from './Overview/Search.vue';
    import Pagination from './Overview/Pagination.vue';
    import Datatable from './Overview/Datatable.vue';
    
    export default {
        data () {
            return {
                page: 1,
                perPage: 100,
                totalRows: 0,
                rows: [],
                serverParams: {
                    page: 1,
                    per_page: 100,
                    columnFilters: {}
                }
            }
        },
        components: {
            Search,
            Pagination,
            Datatable
        },
        computed: {
            totalPages() {
                return Math.ceil( this.totalRows / this.perPage );
            }
        },
        created () {
            this.loadItems();
        },
        methods: {
            loadItems() {
                axios
                .get(`/api/overview`, {
                    params: this.serverParams
                })
                .then(response => {
                    this.totalRows = response.data.totalRows;
                    this.rows = response.data.rows;
                }).catch(error => {
                    //console.log(error);
                });
            },
            updateParams(newProps) {
                this.serverParams = Object.assign({}, this.serverParams, newProps);
            },
            changeFilters(newFilters) {
                this.updateParams({ columnFilters: newFilters });
                this.loadItems();
            },
            changePage(newPage) {
                this.page = newPage;
                this.updateParams({ page: this.page });
                this.loadItems();
            },
            changePerPage(newPerPage) {
                this.perPage = newPerPage;
                this.updateParams({ per_page: this.perPage });
                this.loadItems();
            },
            logout () {
                this.$store.dispatch('logout');
                this.$router.push('/');
            },
        }
    }

</script>

<style>

</style>
