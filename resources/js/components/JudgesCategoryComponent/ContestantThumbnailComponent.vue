<template>
    <div class="col-md-3">
        <a class="thumbnail" data-toggle="modal" :data-target="'#myModal'+contestant.id+category.id">
            <div id="seqno"><span class="no">{{ contestant.number }}</span></div>
            <center>
                <img :src="'/storage/cover_image/'+contestant.cover_image" class="img-fluid" width="200" height="150" :alt="contestant.name" />
                <h2>{{ contestant.name }}</h2><span>({{ contestant.representing }})</span>
            </center>
        </a>
        <scoresheet-component :contestant="contestant" :category="category"></scoresheet-component>
    </div>
</template>
<script>
    module.exports = {
        props: ['contestant','category'],
        methods:{
            fetch(){
                this.$parent.fetchCategory();
            }
        }
    }
</script>
<style scoped>
    img{
        margin-top:10px;
        margin-bottom:10px;
    }

    .thumbnail{
        display: block;
        margin-top: 10px;
        border: 1px solid #0001;
        width: 290px;
        height:350px;
    }

    .thumbnail h2{
        font-size: 20px;
        font-weight: bold;
    }

    .thumbnail h2 span{
        color: red;
    }

    #seqno{
        height: 30px;
        width: 30px;
        position: absolute;
    }

    #seqno span{
        font-size: 17px;
        font-weight:bold;
        margin-left:12px;
    }
    .no{
        font-weight: bolder;
    }
    a{
        text-decoration: none;
    }
</style>