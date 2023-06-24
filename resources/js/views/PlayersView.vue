<script setup>
import { ref, reactive } from "vue";
import axios from "axios";
import useLines from "@/composables/useLines";
import usePlayers from "@/composables/usePlayers";

const { lines, getLines } = useLines();
const { deletePlayer, getPlayers, players, isLoading } = usePlayers();

const dialogFormVisible = ref(false);
const form = reactive({
    name: "",
    shirt_number: "",
    line_id: "",
    in_lineup: false,
});

const savePlayer = () => {
    axios
        .post("api/players", form)
        .then(() => {
            dialogFormVisible.value = false;
            ElNotification({
                title: "Success",
                message: "Player was saved successfully!",
                type: "success",
            });
            getPlayers();
        })
        .catch(({ response }) => {
            ElNotification({
                title: "Error",
                message: response.data.message,
                type: "error",
            });
        })
        .finally(() => {
            isLoading.value = false;
        });
};

getLines();
getPlayers();
</script>

<template>
    <!-- Form -->
    <el-button @click="dialogFormVisible = true" type="primary">
        Add new player
    </el-button>

    <el-dialog v-model="dialogFormVisible" title="Add new player">
        <el-form :model="form">
            <el-form-item label="Name" label-width="140px">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Shirt Number" label-width="140px">
                <el-input v-model="form.shirt_number" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Line" label-width="140px">
                <el-select
                    v-model="form.line_id"
                    class="m-2"
                    style="width: 100%;"
                    placeholder="Select"
                >
                    <el-option
                        v-for="line in lines"
                        :key="line.id"
                        :label="line.name"
                        :value="line.id"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="Shirt Number" label-width="140px">
                <el-switch v-model="form.in_lineup" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="dialogFormVisible = false">Cancel</el-button>
                <el-button type="primary" @click="savePlayer">
                    Confirm
                </el-button>
            </span>
        </template>
    </el-dialog>

    <el-scrollbar>
        <el-table :data="players" v-loading="isLoading">
            <el-table-column prop="id" label="#" />
            <el-table-column prop="name" label="Name" />
            <el-table-column prop="shirt_number" label="Shirt Number" />
            <el-table-column label="Line">
                <template #default="scope">
                    {{ scope.row.line.name }}
                </template>
            </el-table-column>
            <el-table-column label="In Lineup?">
                <template #default="scope">
                    <el-tag class="ml-2" type="success" v-if="scope.row.in_lineup">Yes</el-tag>
                    <el-tag class="ml-2" type="error" v-else="scope.row.in_lineup">No</el-tag>
                </template>
            </el-table-column>
            <el-table-column fixed="right" label="Actions" width="300">
                <template #default="scope">
                    <el-button type="primary" size="small">Edit</el-button>
                    <el-popconfirm
                        width="250"
                        confirm-button-text="OK"
                        cancel-button-text="No, Thanks"
                        icon-color="#ff5e5e"
                        title="Are you sure you want to delete this?"
                        @confirm="deletePlayer(scope.row.id)"
                    >
                        <template #reference>
                            <el-button type="danger" size="small"
                                >Delete</el-button
                            >
                        </template>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>
    </el-scrollbar>
</template>
