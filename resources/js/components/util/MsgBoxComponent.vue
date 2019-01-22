<template>
    <div class="modal fade" :id="'msgBox'+data.id" tabindex="-1" role="dialog" aria-labelledby="msgBoxLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="msgBoxLabel">{{ params.title }}</h3>
            </div>
            <div class="modal-body">
                {{ params.message }}
            </div>
            <div v-if="params.type=='confirm'" class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="yesButtonClick">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="noButtonClick">No</button>
            </div>
            <div v-if="params.type=='info'" class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="okButtonClick">OK</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['value','params','data'],
    methods: {
        yesButtonClick(event) {
            let result = {
                yes:true,
                data: this.data.id
            };
            this.$emit('clicked',result);
        },
        noButtonClick(event) {
            let result = {
                yes:false,
                data:this.data.id
            };
            this.$emit('clicked',result);
        },
        okButtonClick(event){
            let result = {
                yes : false,
                data: this.data.id
            };
        }
    }
}
</script>

