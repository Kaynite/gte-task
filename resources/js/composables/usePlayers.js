import axios from "axios";
import { ref } from "vue";

export default function usePlayers() {
    const players = ref([]);
    const isLoading = ref(false);

    const getPlayers = () => {
        isLoading.value = true;
        axios.get("api/players").then(({ data }) => {
            players.value = data.data;
            isLoading.value = false;
        });
    };

    const savePlayer = (data) => {
        return new Promise((resolve, reject) => {
            axios
                .post("api/players", data)
                .then(() => {
                    ElNotification({
                        title: "Success",
                        message: "Player was saved successfully!",
                        type: "success",
                    });
                    getPlayers();
                    resolve();
                })
                .catch(({ response }) => {
                    ElNotification({
                        title: "Error",
                        message: response.data.message,
                        type: "error",
                    });
                    reject(response.data.message);
                });
        });
    };

    const updatePlayer = (player) => {
        return new Promise((resolve, reject) => {
            axios
                .put(`api/players/${player.id}`, player)
                .then(() => {
                    ElNotification({
                        title: "Success",
                        message: "Player was saved successfully!",
                        type: "success",
                    });
                    getPlayers();
                    resolve();
                })
                .catch(({ response }) => {
                    ElNotification({
                        title: "Error",
                        message: response.data.message,
                        type: "error",
                    });
                    reject(response.data.message);
                });
        });
    };

    const deletePlayer = (id) => {
        axios
            .delete(`api/players/${id}`)
            .then(() => {
                ElNotification({
                    title: "Success",
                    message: "player was deleted successfully!",
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
            });
    };

    return {
        players,
        isLoading,
        deletePlayer,
        getPlayers,
        savePlayer,
        updatePlayer,
    };
}
