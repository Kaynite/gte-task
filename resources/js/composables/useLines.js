import axios from "axios";
import { ref } from "vue";

export default function useLines() {
    const lines = ref([]);

    const getLines = () => {
        axios.get("api/lines").then(({ data }) => {
            lines.value = data.data;
        });
    };

    const deleteLine = (id) => {
        axios
            .delete(`api/lines/${id}`)
            .then(() => {
                ElNotification({
                    title: "Success",
                    message: "Line was deleted successfully!",
                    type: "success",
                });
                getLines();
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
        deleteLine,
        lines,
        getLines,
    };
}
