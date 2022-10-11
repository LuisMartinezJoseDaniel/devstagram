/** @type {import('tailwindcss').Config} */
module.exports = {
    // indicar a tailwind que aplique estilos a la paginacion
    content: ["./resources/**/*.blade.php", "./resources/**/*.js","./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"],
    theme: {
        extend: {
            container: {
                padding: '2rem'
            }
        },
    },
    plugins: [],
};
