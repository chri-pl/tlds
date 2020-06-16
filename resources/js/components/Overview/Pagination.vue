<template>
    <div class="float-right">
        <div class="clearfix">
            <div class="float-left">
                <select v-model="proxyPerPage">
                    <option 
                        v-for="rowsPerPage in rowsPerPageList" 
                        :value="rowsPerPage"
                    >
                        {{ rowsPerPage }}
                    </option>
                </select>
                &nbsp;
                Zeilen
                &nbsp;
            </div>
            <div class="float-left">
                &nbsp;
                <a href="#" v-on:click.prevent.stop="firstPage()">
                    << <span>First</span>
                </a>
                &nbsp;
                <a href="#" v-on:click.prevent.stop="previousPage()">
                    < <span>Prev</span>
                </a>
                &nbsp;
            </div>
            <div class="float-left">
                &nbsp;
                Seite 
                <input type="text" 
                       :value="page"
                       v-on:keyup.enter.stop="changePage"
                >
                von {{ totalPages }}
                &nbsp;
            </div>
            <div class="float-left">
                &nbsp;
                <a href="#" v-on:click.prevent.stop="nextPage()">
                    > <span>Next</span>
                </a>
                &nbsp;
                <a href="#" v-on:click.prevent.stop="lastPage()">
                    >> <span>Last</span>
                </a>
                &nbsp;
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            page: {
                default: 0
            },
            perPage: {
                default: 0
            },
            totalRows: {
                default: 0
            },
            totalPages: {
                default: 0
            }
        },
        data () {
            return {
                rowsPerPageList: [
                    '50',
                    '100',
                    '200',
                    '500'
                ]
            }
        },
        computed : {
            proxyPerPage: {
                get: function () {
                    return this.perPage;
                },
                set: function (newValue) {
                    this.$emit('per-page-changed', newValue);
                }
            }
        },
        methods: {
            firstPage() {
                if  ( this.page > 1 ) {
                    let newPage = 1;
                    this.$emit('page-changed', newPage);
                }
            },
            previousPage() {
                if ( this.page > 1 ) {
                    let newPage = this.page;
                    newPage--;
                    this.$emit('page-changed', newPage);
                }
            },
            nextPage() {
                if ( this.page < this.totalPages ) {
                    let newPage = this.page;
                    newPage++;
                    this.$emit('page-changed', newPage);
                }
            },
            lastPage() {
                if ( this.propPage < this.totalPages ) {
                    let newPage = this.totalPages;
                    this.$emit('page-changed', newPage);
                }
            },
            changePage() {
                
                let newPage = parseInt(event.target.value, 10);

                if (
                    Number.isNaN(newPage) === false &&
                    newPage > 1 &&
                    newPage < Math.floor( this.totalRows / this.perPage )
                ) {
                    this.$emit('page-changed', newPage);
                } else {
                    event.target.value = this.page;
                }
            }
        }
    }

</script>

<style>

    
</style>
