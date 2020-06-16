<template>
    <div class="float-right">
        <div class="clearfix">
            <div class="float-left">
                <select v-model="propPerPage" v-on:change="changePerPage()">
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
                       v-on:keyup.enter.stop="changePage"
                       :value="propPage"
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
                propPage: this.page,
                propPerPage: this.perPage,
                rowsPerPageList: [
                    '50',
                    '100',
                    '200',
                    '500'
                ]
            }
        },
        methods: {
            firstPage() {
                if ( this.page > 1 ) {
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
                if ( this.page < this.totalPages ) {
                    this.$emit('page-changed', this.totalPages);
                }
            },
            changePage() {
                
                let newPage = parseInt(event.target.value, 10);

                if (
                    Number.isNaN(newPage) === false &&
                    newPage > 1 &&
                    newPage < Math.floor( this.totalRows / this.perPage )
                ) {
                    this.propPage = newPage;
                    this.$emit('page-changed', this.propPage);
                } else {
                    event.target.value = this.propPage;
                }
            },
            changePerPage() {
                this.propPerPage = event.target.value;
                this.$emit('per-page-changed', this.propPerPage);
            }
        }
    }

</script>

<style>

    
</style>
