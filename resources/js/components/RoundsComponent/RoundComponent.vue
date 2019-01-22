<template>
    <tr>
        <td>{{ round.name }}</td>
        <td>{{ round.num_tops }}</td>
        <td>
            <button class="btn btn-primary" data-toggle="modal" :data-target="'#modalView'+round.id">View Categories</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#msgBox">Edit</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#msgBox">Delete</button>
        </td>

        <!-- Viewer -->
        <div class="modal fade" :id="'modalView'+round.id" tabindex="-1" role="dialog" aria-labelledby="msgBoxLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="msgBoxLabel">Stage Category - {{ round.name }}</h3>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </div> 
        <!-- End Viewer -->
    </tr>
</template>
<script>
import axios from 'axios';
export default {
    props: ['round'],
    methods: {
        getRound:function(){
            console.log(this.round);
        }
    }
}
</script>

