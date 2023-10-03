import { defineStore } from "pinia";

export const useCommentStore = defineStore("commentStore", {
    
    state: () => ({
    
        isLoading: false,
        selectedCommentId:null,
    }),

    getters: {

    },

    actions: {

        async createComment(commendDetails) {
            this.isLoading = true;
            let response = await useApiFetch("/api/comment", {
                method: "POST",
                body: commendDetails
            });
            
            this.isLoading = false;

            return response;
        },


        async deleteComment(commentId) {
         
            let response = await useApiFetch("/api/comment", {
                method: "DELETE",
                body: {comment_id: commentId}
            });
            
            return response;
        },

        async updateComment(commentId, commentBody) {
         
            let response = await useApiFetch("/api/comment", {
                method: "PUT",
                body: {
                    comment_id: commentId,
                    body: commentBody
                }
            });
            
            return response;
        },


    },
});
