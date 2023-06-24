import axios from "axios";
import { ref } from "vue";

export default function useLines() {
    const lines = ref([]);
    const isLoading = ref(false);

    const getLines = () => {
        isLoading.value = true;
        axios.get("api/lines")
            .then(({ data }) => {
                lines.value = data.data;
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    const saveLine = (data) => {
        return new Promise((resolve, reject) => {
            axios
                .post("api/lines", data)
                .then(() => {
                    ElNotification({
                        title: "Success",
                        message: "Line was saved successfully!",
                        type: "success",
                    });
                    getLines();
                    resolve();
                })
                .catch(({ response }) => {
                    ElNotification({
                        title: "Error",
                        message: response.data.message,
                        type: "error",
                    });
                    reject(response.data.message)
                });
        })
    }

    const updateLine = (line) => {
        return new Promise((resolve, reject) => {
            axios
                .put(`api/lines/${line.id}`, {
                    name: line.name,
                    short_name: line.short_name,
                    max_in_lineup: line.max_in_lineup,
                })
                .then(() => {
                    ElNotification({
                        title: "Success",
                        message: "Line was updated successfully!",
                        type: "success",
                    });
                    getLines();
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
        lines,
        getLines,
        saveLine,
        updateLine,
        deleteLine,
        isLoading,
    };
}
