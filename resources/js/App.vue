<template>
    <div class='wrap'>
        <div class='container'>
            <div class='bodywrap'>
                <div class='left'>
                    <div class="burger">
                        <i class="material-icons">dehaze</i>
                    </div>
                </div>
                <div class='right'>
                    <div class="logo">
                        <logo />
                    </div>
                </div>
                <div class='center'>
            		<router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
	export default {
		mounted() {
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

.title-form{
    font-size: 70px;
    text-transform: uppercase;
    line-height: 70px;
    margin-top: 90px;
    margin-bottom: 44px;
    font-family: 'Anton', sans-serif;
    color: black;
}
.title-info {
    margin-bottom: 50px;
}
.title-info-client {
    margin-top: 20px;
}
</style>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
.flex-container {
  display: flex;
  flex-wrap: wrap;
}

.flex-container-col {
  flex: 25%;
  margin: 10px;
  text-align: center;
  font-size: 30px;
}

@media screen and (max-width: 992px) {
  .flex-container-col {
    flex: 50%;
  }
}

@media screen and (max-width: 600px) {
  .flex-container-col {
    flex-direction: column;
  }
}
.pic-team-list {
    display: inline-block;

}

.burger{
    position: relative;
    width: 40px;
    height: 40px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-left: 30px;
    margin-top: 40px;
    color:black;
}
.logo{
    position: relative;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-left: 30px;
    margin-top: 40px;

}

html, body {
    height:100%
}
.wrap {
    width:100%;
    height:100%;
    position:relative
}
.head {
    width:100%
}
.bodywrap {
    margin-top:100px;
}
.left, .right {
    width:100px;
    top: 10px;
    bottom: 0px;
    position: fixed;
}
.left, .center, .right, .bodywrap {
    height:100%
}
.center {
    margin:100px 200px;
}
.left {
    left:0
}
.right {
    right:0
}
.left {
    background-color:white;
}
.right {
    background-color:white;
}
.head {
    background-color:white;
}
.container {
    width:100%;
}
.center{
    width:calc(100% - 400px)
}
</style>
