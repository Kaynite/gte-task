<script setup>
import { computed } from "vue";
import Player from "../components/Player.vue";
import usePlayers from "@/composables/usePlayers";

const { getPlayers, players } = usePlayers();

getPlayers();

const goalkeeper = computed(() => {
    return players.value.find(
        (player) => player.in_lineup && player.line.short_name === "GK"
    );
});

const defenders = computed(() => {
    return players.value.filter(
        (player) => player.in_lineup && player.line.short_name === "DEF"
    );
});

const midfielders = computed(() => {
    return players.value.filter(
        (player) => player.in_lineup && player.line.short_name === "MDF"
    );
});

const attackers = computed(() => {
    return players.value.filter(
        (player) => player.in_lineup && player.line.short_name === "ATK"
    );
});

const starting_players = computed(() => {
    return players.value.filter((player) => player.in_lineup);
});
</script>

<template>
    <el-row v-if="players" :gutter="40">
        <el-col :span="8">
            <el-table :data="starting_players">
                <el-table-column prop="shirt_number" label="#" width="50px" />
                <el-table-column prop="name" label="Name" />
                <el-table-column
                    prop="line.short_name"
                    label="Line"
                    width="100px"
                />
            </el-table>
        </el-col>
        <el-col :span="16" class="pitch">
            <div height="10%">
                <Player :player="goalkeeper" v-if="goalkeeper" />
            </div>
            <div height="10%">
                <Player v-for="defender in defenders" :player="defender" />
            </div>
            <div height="10%">
                <Player
                    v-for="midfielder in midfielders"
                    :player="midfielder"
                />
            </div>
            <div height="10%">
                <Player v-for="attacker in attackers" :player="attacker" />
            </div>
        </el-col>
    </el-row>
</template>
