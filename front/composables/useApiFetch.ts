import { UseFetchOptions } from "nuxt/app";

export function useApiFetch<T> (path: string, options: UseFetchOptions<T> = {}) {
  const config = useRuntimeConfig();
    const url: string = config.public.apiUrl + path;
    let headers: any = {
        accept: "application/json",
        referer: config.public.appUrl,
    };
    const token = useCookie("XSRF-TOKEN");

    if (token.value) {
        headers["X-XSRF-TOKEN"] = token.value as string;
    }

    if (process.server) {
        // add this headers when api executed on server
        headers = {
            ...headers,
            ...useRequestHeaders(["cookie"]),
        };
    }

    return useFetch(url, {
        credentials: "include",
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...options?.headers,
        },
    });
}
