import axios from "axios";
import { ref } from "vue";

export default function usePlayers() {
    const players = ref([]);
    const isLoading = ref(false);

    const getPlayers = () => {
        isLoading.value = true
        axios.get("api/players")
            .then(({ data }) => {
                players.value = data.data;
                isLoading.value = false;
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
    };
}
