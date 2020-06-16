<template>
    <div class="float-left">
        <form v-on:submit.prevent>
            <input type="text"
                   v-model="filters.label"
                   placeholder="Nach TLDs suchen"
                   v-on:keyup.enter.stop="changeFilters"
            >
            <div class="form-check form-check-inline">
                <input type="checkbox"
                       class="form-check-input"
                       checked
                       id="tldTypeCCTLD"
                       v-model="filters.tldType" 
                       value="CCTLD" 
                       v-on:change="changeFilters"
                >
                <label class="form-check-label" for="tldTypeCCTLD">CCTLD</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox"
                       class="form-check-input"
                       checked
                       id="tldTypeGtld"
                       v-model="filters.tldType" 
                       value="GTLD" 
                       v-on:change="changeFilters"
                >
                <label class="form-check-label" for="tldTypeGtld">GTLD</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox"
                       class="form-check-input"
                       checked
                       id="tldTypeNewGtld"
                       v-model="filters.tldType" 
                       value="NEW_GTLD" 
                       v-on:change="changeFilters"
                >
                <label class="form-check-label" for="tldTypeNewGtld">NEW_GTLD</label>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        data () {
            return {
                filters: {
                    label: '',
                    tldType: []
                }
            }
        },
        methods: {
            changeFilters: function() {
                this.$emit('filters-changed', this.filters);
            }
        }
    }

</script>

<style>

    
</style>
