<template>
    <el-container class="layout-container-demo" style="height: 100vh">
        <el-aside width="250px">
            <el-menu>
                <router-link to="/">
                    <el-menu-item> Home </el-menu-item>
                </router-link>
                <router-link :to="{ name: 'lines' }">
                    <el-menu-item>Lines</el-menu-item>
                </router-link>
                <router-link :to="{ name: 'players' }">
                    <el-menu-item>Players</el-menu-item>
                </router-link>
            </el-menu>
        </el-aside>

        <el-container>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>
