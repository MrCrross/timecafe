function toggleTheme()
{
    let theme = localStorage.getItem('theme');
    if (theme === null || theme === 'light') {
        localStorage.theme = 'dark';
    }
    if (theme === null || theme === 'dark') {
        localStorage.theme = 'light';
    }
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
}

function setTheme()
{
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
}
