<script>
    export default {
        methods: {
            $hasRole(roleName) {
                return Roles.indexOf(roleName) !== -1;
            },
        },
    };
</script>
