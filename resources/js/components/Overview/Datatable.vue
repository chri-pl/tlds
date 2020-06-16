<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th v-for="column in columns" scope="col">
                    {{ column.label }}
                </th>
                <th>Mehr</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="(row, index) in rows">
                <tr v-bind:class="getRowClass(index)">
                    <td v-for="column in columns">
                        <span v-if="
                            column.field == 'label' ||
                            column.field == 'tldContinent' ||
                            column.field == 'countrynameDe'
                        ">{{ row[column.field] }}</span>
                        <span v-else-if="column.field == 'tldType'">
                            {{ row[column.field].replace('_', ' ') }}
                        </span>
                        <span v-else >
                            <Checkmark :value="row[column.field]" />
                        </span>
                    </td>
                    <td>
                        <span class="show-more" v-on:click.prevent="showDetailRow(index)">
                            <svg class="bi bi-three-dots" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                        </span>
                    </td>
                </tr>
                <tr v-bind:class="getRowClass(index + 1)" style="display: none;">
                    <td colspan="11">EXTRA DATEN</td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<script>
    
    import Checkmark from './Checkmark.vue';

    export default {
        props: {
            rows: {
                type: Array,
                default: () => []
            }
        },
        data () {
            return {
                columns: [
                    { label: 'TLD', field: 'label' },
                    { label: 'Typ', field: 'tldType' },
                    { label: 'Kontinent', field: 'tldContinent' },
                    { label: 'Land', field: 'countrynameDe' },
                    { label: 'Authinfo', field: 'transferAuthinfo' },
                    { label: 'DNSSEC', field: 'dnssecRecord' },
                    { label: 'Kontakterweiterungen', field: 'contactExtensions' },
                    { label: 'Privacy', field: 'privacy' },
                    { label: 'Trustee', field: 'trustee' },
                    { label: 'Premium', field: 'premiumDomains' }
                ]
            }
        },
        components: {
            Checkmark
        },
        methods: {
            getRowClass(rowIndex) {
                return 'row-' + rowIndex;
            },
            showDetailRow(rowIndex) {
                
                let detailRowIndex = rowIndex + 1;

                if ( document.querySelector('tr.row-' + detailRowIndex).style.display == 'table-row' ) {
                    document.querySelector('tr.row-' + detailRowIndex).style.display = 'none';
                } else {
                    document.querySelector('tr.row-' + detailRowIndex).style.display = 'table-row';
                }
            }
        }
    }

</script>

<style scoped>

    span.show-more {
        cursor: pointer;
    }
    
    table th,
    table td {
        text-align: center;
    }

    table thead > tr > th {
        position: sticky;
        position: -webkit-sticky;
        z-index: 999999;
        top: 0;
        background-color: #f8fafc;
    }
    
</style>
