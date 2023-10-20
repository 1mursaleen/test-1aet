const endpoints = {
    login: () => `/fortify/login`,
    register: () => `/fortify/register`,
    logout: () => `/fortify/logout`,
    user: () => `/user`,
    trackRank: () => `/analytics/trackRank`,
    searchHistory: (page = 1) => `/search?page=${ page }`,
    searchDetails: (id = 1) => `/search/${ id }`,
}

export default endpoints
