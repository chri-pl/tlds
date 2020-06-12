<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <a class="navbar-brand" href="#">TLDs Overview</a>
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
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :totalRows="totalRows"
            :isLoading.sync="isLoading"
            :sort-options="{
                enabled: false
            }"
            :pagination-options="{
                enabled: true,
                mode: 'pages',
                dropdownAllowAll: false
            }"
            @on-column-filter="onColumnFilter"
            @on-page-change="onPageChange"
            @on-per-page-change="onPerPageChange"
            mode="remote"
            max-height="800px"
        />
        </vue-good-table>
    </div>
</template>

<script>
    
    import 'vue-good-table/dist/vue-good-table.css'
    import { VueGoodTable } from 'vue-good-table';
    
    export default {
        data () {
            return {
                isLoading: false,
                columns: [
                    {
                        label: 'TLD',
                        field: 'label',
                        filterOptions: {
                            enabled: true,
                            placeholder: ' ',
                            //trigger: 'enter'
                        }
                    },
                    {
                        label: 'thirdLevel',
                        field: 'thirdLevel',
                        type: 'number'
                    },
                    {
                        label: 'tldType',
                        field: 'tldType',
                        filterOptions: {
                            enabled: true,
                            placeholder: ' ',
                            filterDropdownItems: [
                                'CCTLD',
                                'GTLD',
                                'NEW_GTLD'
                            ]
                        }
                    },
                    {
                        label: 'rankingLevel',
                        field: 'rankingLevel',
                        type: 'number'
                    },
                    {
                        label: 'isManual',
                        field: 'isManual',
                        type: 'boolean'
                    },
                    {
                        label: 'ownerchangeAuthinfo',
                        field: 'ownerchangeAuthinfo',
                        type: 'boolean'
                    },
                    {
                        label: 'transferAuthinfo',
                        field: 'transferAuthinfo',
                        type: 'boolean'
                    },
                    {
                        label: 'transferImportedContacts',
                        field: 'transferImportedContacts',
                        type: 'boolean'
                    },
                    {
                        label: 'charMin',
                        field: 'charMin',
                        type: 'number'
                    },
                    {
                        label: 'charMax',
                        field: 'charMax',
                        type: 'number'
                    },
                    {
                        label: 'nserverMin',
                        field: 'nserverMin',
                        type: 'number'
                    },
                    {
                        label: 'nserverMax',
                        field: 'nserverMax',
                        type: 'number'
                    },
                    {
                        label: 'ipv4Min',
                        field: 'ipv4Min',
                        type: 'number'
                    },
                    {
                        label: 'ipv4Max',
                        field: 'ipv4Max',
                        type: 'number'
                    },
                    {
                        label: 'ipv6Min',
                        field: 'ipv6Min',
                        type: 'number'
                    },
                    {
                        label: 'ipv6Max',
                        field: 'ipv6Max',
                        type: 'number'
                    },
                    {
                        label: 'nsentryMin',
                        field: 'nsentryMin',
                        type: 'number'
                    },
                    {
                        label: 'nsentryMax',
                        field: 'nsentryMax',
                        type: 'number'
                    },
                    {
                        label: 'dnssecRecord',
                        field: 'dnssecRecord',
                        type: 'number'
                    },
                    {
                        label: 'rootNserver',
                        html: true,
                        field: (row) => this.formatArray(row.rootNserver)
                    },
                    {
                        label: 'restoreArgpPeriod',
                        field: 'restoreArgpPeriod',
                        formatFn: this.formatPeriod
                    },
                    {
                        label: 'restoreRgpPeriod',
                        field: 'restoreRgpPeriod',
                        formatFn: this.formatPeriod
                    },
                    {
                        label: 'cancelationPeriod',
                        field: 'cancelationPeriod',
                        formatFn: this.formatPeriod
                    },
                    {
                        label: 'taskCreate',
                        field: 'taskCreate',
                        type: 'boolean'
                    },
                    {
                        label: 'taskUpdate',
                        field: 'taskUpdate',
                        type: 'boolean'
                    },
                    {
                        label: 'taskDelete',
                        field: 'taskDelete',
                        type: 'boolean'
                    },
                    {
                        label: 'taskRenew',
                        field: 'taskRenew',
                        type: 'boolean'
                    },
                    {
                        label: 'taskTransfer',
                        field: 'taskTransfer',
                        type: 'boolean'
                    },
                    {
                        label: 'taskTransit',
                        field: 'taskTransit',
                        type: 'boolean'
                    },
                    {
                        label: 'taskOwnerChange',
                        field: 'taskOwnerChange',
                        type: 'boolean'
                    },
                    {
                        label: 'taskPreack',
                        field: 'taskPreack',
                        type: 'boolean'
                    },
                    {
                        label: 'taskRestore',
                        field: 'taskRestore',
                        type: 'boolean'
                    },
                    {
                        label: 'taskAuthinfoCreate',
                        field: 'taskAuthinfoCreate',
                        type: 'boolean'
                    },
                    {
                        label: 'taskAuthinfoDelete',
                        field: 'taskAuthinfoDelete',
                        type: 'boolean'
                    },
                    {
                        label: 'taskAuthinfo2',
                        field: 'taskAuthinfo2',
                        type: 'boolean'
                    },
                    {
                        label: 'taskStatusUpdate',
                        field: 'taskStatusUpdate',
                        type: 'boolean'
                    },
                    {
                        label: 'registrarStatus',
                        html: true,
                        field: (row) => this.formatArray(row.registrarStatus)
                    },
                    {
                        label: 'numeralDomains',
                        field: 'numeralDomains',
                        type: 'boolean'
                    },
                    {
                        label: 'realtime',
                        field: 'realtime',
                        type: 'boolean'
                    },
                    {
                        label: 'idn',
                        html: true,
                        field: (row) => this.formatArray(row.idn)
                    },
                    {
                        label: 'commentEn',
                        field: 'commentEn'
                    },
                    {
                        label: 'commentDe',
                        field: 'commentDe'
                    },
                    {
                        label: 'confluencePageDe',
                        field: 'confluencePageDe'
                    },
                    {
                        label: 'confluencePageEn',
                        field: 'confluencePageEn'
                    },
                    {
                        label: 'cancelationExpireOnly',
                        field: 'cancelationExpireOnly',
                        type: 'boolean'
                    },
                    {
                        label: 'privacy',
                        field: 'privacy',
                        type: 'boolean'
                    },
                    {
                        label: 'trustee',
                        field: 'trustee',
                        type: 'boolean'
                    },
                    {
                        label: 'errorCodes',
                        html: true,
                        field: (row) => this.formatArray(row.errorCodes)
                    },
                    {
                        label: 'requiredFields',
                        html: true,
                        field: (row) => this.formatArray(row.requiredFields)
                    },
                    {
                        label: 'authinfo1Location',
                        html: true,
                        field: (row) => this.formatArray(row.authinfo1Location)
                    },
                    {
                        label: 'dnssecMin',
                        field: 'dnssecMin',
                        type: 'number'
                    },
                    {
                        label: 'dnssecMax',
                        field: 'dnssecMax',
                        type: 'number'
                    },
                    {
                        label: 'dnssecAlgorithms',
                        html: true,
                        field: (row) => this.formatArray(row.dnssecAlgorithms)
                    },
                    {
                        label: 'whois',
                        field: 'whois'
                    },
                    {
                        label: 'countryIso',
                        field: 'countryIso'
                    },
                    {
                        label: 'geoPol',
                        field: 'geoPol'
                    },
                    {
                        label: 'categories',
                        html: true,
                        field: (row) => this.formatArray(row.categories)
                    },
                    {
                        label: 'officialLanguage',
                        field: 'officialLanguage'
                    },
                    {
                        label: 'tldTasks',
                        html: true,
                        field: (row) => this.formatTask(row.tldTasks)
                    },
                    {
                        label: 'tldDns',
                        html: true,
                        field: (row) => this.formatObject(row.tldDns)
                    },
                    {
                        label: 'tldPeriod',
                        html: true,
                        field: (row) => this.formatTldPeriod(row.tldPeriod)
                    },
                    {
                        label: 'restrictions',
                        html: true,
                        field: (row) => this.formatObjectsArray(row.restrictions)
                    },
                    {
                        label: 'preregInformation',
                        html: true,
                        field: (row) => this.formatObjectsArray(row.preregInformation)
                    },
                    {
                        label: 'country',
                        html: true,
                        field: (row) => this.formatObject(row.country)
                    },
                    {
                        label: 'dataControllers',
                        html: true,
                        field: (row) => this.formatObjectsArray(row.dataControllers)
                    }
                ],
                rows: [],
                totalRows: 0,
                serverParams: {
                    columnFilters: {
                    },
                    page: 1,
                    per_page: 10
                }
            }
        },
        components: {
            VueGoodTable
        },
        created () {
            this.loadItems();
        },
        methods: {
            logout () {
                this.$store.dispatch('logout');
                this.$router.push('/');
            },
            updateParams(newProps) {
                this.serverParams = Object.assign({}, this.serverParams, newProps);
            },
            onPageChange(params) {
                this.updateParams({page: params.currentPage});
                this.loadItems();
            },
            onPerPageChange(params) {
                this.updateParams({per_page: params.currentPerPage});
                this.loadItems();
            },
            onColumnFilter(params) {
                this.updateParams(params);
                this.loadItems();
            },
            loadItems() {
                axios
                .get(`/api/overview`, {
                    params: this.serverParams
                })
                .then(response => {
                    this.rows = response.data.rows;
                    this.totalRows = response.data.totalRows;
                }).catch(error => {
                    //console.log(error);
                });
            },
            formatArray (values) {
                
                if ( Array.isArray(values) && values.length > 0 ) {
                    
                    var iterator = values.values();
                    
                    let list = '<ul class="vgt-column-list">';
                    
                    for ( let val of iterator ) {
                        list += '<li>' + val + "</li>";
                    }
                    
                    list += '</ul>';

                    return list;
                }
            },
            formatObject (obj) {
                
                if ( obj !== null && Object.keys(obj).length > 0 ) {

                    let list = '<ul class="vgt-column-list">';
                    
                    for ( let prop in obj ) {

                        if ( obj[prop] === null ) {
                            continue;
                        }
                        
                        if ( Array.isArray(obj[prop]) ) {
                            
                            list += '<li><b>' + prop + '</b>';
                            list += this.formatArray(obj[prop]);
                            
                        } else if ( Object.keys(obj[prop]).length > 0 ) {
                            
                            list += '<li><b>' + prop + '</b></li>';
                            list += '<li>' + obj[prop] + '</li>';
                        }
                    }
                    
                    list += '</ul>';

                    return list;
                }
            },
            formatObjectsArray (values) {
                
                if ( Array.isArray(values) && values.length > 0 ) {
                    
                    var iterator = values.values();
                    
                    let list = '<ul class="vgt-column-list">';
                    
                    for ( let obj of iterator ) {
                        list += this.formatObject(obj);
                    }
                    
                    list += '</ul>';

                    return list;
                }
            },
            formatPeriod (value) {
                if ( value ) {
                    return value.period + ' ' + value.unit;
                }
            },
            formatTldPeriod (obj) {

                if ( obj !== null && Object.keys(obj).length > 0 ) {

                    let list = '<ul class="vgt-column-list">';
                    
                    for ( let prop in obj ) {

                        list += '<li><b>'+ prop + '</b></li>';
                        list += this.formatPeriod(obj[prop]);
                    }
                    
                    list += '</ul>';

                    return list;
                }
            },
            formatTask (values) {
                
                if ( Array.isArray(values) && values.length > 0 ) {
                    
                    var iterator = values.values();

                    let list = '<ul class="vgt-column-list">';
                    
                    for ( let val of iterator ) {
                        
                        list += '<li>';
                        list += '<b>' + val.label + '</b><br>';
                        list += 'available: ';
                        list += ( val.available == true ) ? 'Yes' : 'No';
                        list += '<br>';
                        list += 'chargeable: ';
                        list += ( val.chargeable == true ) ? 'Yes' : 'No';
                        list += '<br>';
                        list += '</li>';
                    }
                    
                    list += '</ul>';

                    return list;
                }
            }
        }
    }

</script>

<style>
    
    /* Funktioniert nicht in Chrome
    .vgt-table thead {
        position: sticky;
        position: -webkit-sticky;
        top: 0;
        z-index: 999;
    }
    */

    .vgt-table thead > tr > th {
        height: 50px;
        position: sticky;
        position: -webkit-sticky;
        z-index: 999;
    }

    .vgt-table thead > tr:first-child > th {
        top: 0;
        border-bottom: none !important;
    }

    .vgt-table thead > tr:not(:first-child) > th {
        top: 50px;
        border-top: none !important;
    }

    ul.vgt-column-list {
        list-style-type: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
</style>
