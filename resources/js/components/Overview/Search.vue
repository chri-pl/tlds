<template>
    <div class="float-left">
        <form v-on:submit.prevent="">
            <input type="text"
                   v-model="label"
                   placeholder="Nach TLDs suchen"
                   v-on:keyup.enter.stop="changeFilters"
            >
            <div class="form-check form-check-inline">
                <input type="checkbox" checked
                       id="tldType-CCTLD"
                       v-model="tldType" 
                       value="CCTLD" 
                       v-on:click="changeFilters"
                       class="form-check-input"
                >
                <label class="form-check-label" for="tldType-CCTLD">CCTLD</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" checked
                       id="tldType-GTLD"
                       v-model="tldType" 
                       value="GTLD" 
                       v-on:click="changeFilters"
                       class="form-check-input"
                >
                <label class="form-check-label" for="tldType-GTLD">GTLD</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" checked
                       id="tldType-NEW_GTLD"
                       v-model="tldType" 
                       value="NEW_GTLD" 
                       v-on:click="changeFilters"
                       class="form-check-input"
                >
                <label class="form-check-label" for="tldType-NEW_GTLD">NEW_GTLD</label>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        props: {
        },
        data () {
            return {
                label: '',
                tldType: [],
                filters: {
                }
            }
        },
        methods: {
            changeFilters: function() {
                this.$emit('filters-changed', {
                    label: this.label,
                    tldType: this.tldType
                });
            }
        }
    }

</script>

<style>

    
</style>
