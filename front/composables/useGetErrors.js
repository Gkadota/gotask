
export function useGetErrors (apiError) {
    return  apiError.value?.data?.errors;
}
