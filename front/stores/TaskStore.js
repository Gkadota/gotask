import { defineStore } from "pinia";
import { useAuthStore } from "./AuthStore";

const STATUS = {
    open: "OPEN",
    in_progress: "IN PROGRESS",
    done: "DONE",
    closed: "CLOSED",
    wont_do: "WON'T DO",
};

const PRIORITY = {
    low: "LOW",
    medium: "MEDIUM",
    high: "HIGH",
};

export const useTaskStore = defineStore("taskStore", {
    
    state: () => ({
        tasks: reactive([]),
        isLoading: false,
        selectedTaskId:null,
        isTaskLoaded:false,
    }),

    getters: {
    

        getOpen() {
            return this.tasks?.filter((t) => t.status === STATUS.open);
        },
        getInProgress() {
            return this.tasks?.filter((t) => t.status === STATUS.in_progress);
        },
        getDone() {
            return this.tasks?.filter((t) => t.status === STATUS.done);
        },

        getClose() {
            return this.tasks?.filter((t) => t.status === STATUS.closed);
        },

        getWontDo() {
            return this.tasks?.filter((t) => t.status === STATUS.wont_do);
        },

        getLowPriority() {
            return this.tasks?.filter((t) => t.priority === PRIORITY.low);
        },

        getMediumPriority() {
            return this.tasks?.filter((t) => t.priority === PRIORITY.medium);
        },

        getHighPriority() {
            return this.tasks?.filter((t) => t.priority === PRIORITY.high);
        },

        selectTaskById() {
            return this.tasks?.filter((t) => t.id === this.selectedTaskId);
        },

    
    },

    actions: {
        async getTasks() {
            this.isLoading = true;
            const authStore = useAuthStore();
            let { data, error } = await useApiFetch("/api/tasks", {
                query: { 
                    assignee_id: authStore.user?.id,
                 },
            });

            if (data.value) {
                this.tasks = data.value;
                this.isTaskLoaded = true;
            }
            this.isLoading = false;
        },


        async searchTask(searchTerm) {
            const authStore = useAuthStore();
            let { data, error } = await useApiFetch("/api/tasks", {
                query: { 
                    term: searchTerm,
                    assignee_id: authStore.user?.id,
                 },
            });

            this.tasks = data.value;
        },
        /**
         * Get a a specific task resource using it's id
         * @param {Number} taskId 
         * @returns 
         */
        async getTaskById(taskId) {
            this.isLoading = true;

            let response = await useApiFetch("/api/tasks/" + taskId);

            this.isLoading = false;

            return response;
        },

        async createTask(taskDetails) {
            this.isLoading = true;
            let response = await useApiFetch("/api/task", {
                method: "POST",
                body: taskDetails
            });
            this.isLoading = false;

            return response;
        },

        async updateTask(taskDetails) {
            this.isLoading = true;
            let response = await useApiFetch("/api/task", {
                method: "PUT",
                body: taskDetails
            });
            this.isLoading = false;

            return response;
        },


        async deleteTask(taskId) {
         
            let response = await useApiFetch("/api/task", {
                method: "DELETE",
                body: {id: taskId}
            });
            

            return response;
        },

       
    },
});
