<template>
<div>
    <div class='wrap'>
        <div class='container'>
            <div class='bodywrap'>
                <div class='left'>
                    <div class="burger" @click="openMenu">
                        <inline-svg
                            @click="closeMenu()"
                            :src="burgerIcon"
                            width="38"
                            height="30"
                            fill="black"
                            aria-label="Close"
                        ></inline-svg>
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
    <div id="mySidenav" class="sidenav">
        <div class="header-sidenav">
            <div style="float:left"  class="closebtn">
                    <inline-svg
                    @click="closeMenu()"
                    :src="closeBlack"
                    width="38"
                    height="30"
                    fill="black"
                    aria-label="Close"
                ></inline-svg>
            </div>
            <div class="logo-side" >
                <inline-svg
                    :src="logoSig"
                    width="50"
                    height="50"
                    fill="white"
                    aria-label="Logo"
                ></inline-svg>

            </div>
        </div>
        <div class="options-sidenav">
            <a @click.prevent="goMenu('home')">Home</a>
            <a @click.prevent="goMenu('admin.projects')">Projects</a>
            <a @click.prevent="goMenu('admin.members')">Members</a>
            <a @click.prevent="goMenu('admin.clients')">Clients</a>
        </div>
    </div>
</div>
</template>



<script>

	export default {
        data (){
            return {
                burgerIcon: require('./assets/menu.svg'),
                logoSig: require('./assets/signifly.svg'),
                closeBlack: require('./assets/close-black.svg'),
            }
        },
		methods: {
            goMenu (toRoute) {
                this.$goRouter(toRoute)
                this.closeMenu()
            },
            openMenu (){
                document.getElementById("mySidenav").style.width = "100%";
            },
            closeMenu() {
                document.getElementById("mySidenav").style.width = "0";
            }
		}
	}
</script>

<style>
.loadingDatatable {
    font-weight: bold;
    font-size: 20px;
    text-align: center;
}
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

.cEditIcon{
    cursor: pointer;
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
    margin-left: 25px;
    margin-top: 40px;
    color:black;
    background-color: white;
    border-radius: 50px;
}
.burger img {
    width: 30px;
    position: relative;
    left: 5px;
    top: 5px;
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
.left {
    width:100px;
    top: 10px;
    bottom: 0px;
    position: fixed;
}
.right {
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
    background-color:transparent;
}
.right {
    background-color:transparent;
}
.head {
    background-color:transparent;
}
.container {
    width:100%;
}
.center{
    width:calc(100% - 400px)
}

@media screen and (max-width: 992px) {
    .center{
        width:calc(100% - 10px);
        margin: 100px 10px 0 4px;
    }
    .sidenav {
        text-align: center;
    }
    .sidenav a{
        font-size: 20px;
    }
}

@media screen and (max-width: 600px) {
    .center{
        width:calc(100% - 10px);
        margin: 100px 10px 0 4px;
    }
    .sidenav {
        text-align: center;
    }
    .sidenav a{
        font-size: 20px;
    }
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #4f00cf;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 10px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
    color: #fff;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 70px;
    font-weight: 700;
    transition: opacity .3s;
    line-height: 1;
    margin-left: 0;
    font-family: 'Anton', sans-serif;
    cursor: pointer;
}

.sidenav a:hover{
  color: #f1f1f1;
}


.closebtn  {
  background-color: white;
  border-radius: 50%;
  float: left;
    margin-left: 25px;
    margin-top: 40px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.logo-side {
    float: right;
    margin-right: 17px;
    margin-top: 23px;
}

.options-sidenav  {
    margin-top:100px;
    text-align:left;
    margin-left: 50px;
}

.header-sidenav div {
    display: inline-block;
}
</style>
