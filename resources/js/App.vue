<template>
	<div>
		<router-view></router-view>
	</div>
</template>


<script>
	export default {
		mounted() {
			console.log('App.vue')
		}
	}
</script>

<style>
.box-main-content {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 98%;
  min-height: 300px;
  border-radius: 5px;
  margin-top:10px;
  margin-left: 10px;
}

.box-main-content-container {
  padding: 2px 16px;
  padding-bottom: 15px;
}
.box-bottom {
    display: flex;
    justify-content: flex-end;
}
.box-bottom div{
    display: inline-block;
}

.tabBox table {
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed;
  font-size: 14px;
}
.tabBox thead > tr > th{
    font-weight: bold;
    color:black;
}
.tabBox td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}
.tabBox tbody > tr:hover {background-color:#f5f5f5;}
.colActions {
    display: flex;
    justify-content: center;
}
.colActions div {
    display:inline-block
}
</style>
