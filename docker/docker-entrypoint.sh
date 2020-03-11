if [[ "$1" == apache2* ]] || [ "$1" == php-fpm ]; then
    [[ ! -f "${PLUGIN_DIR}/${PLUGIN_NAME}.php" ]] && \
        echo >&2 "'${PLUGIN_NAME}' plugin not found. Installing..." && \
        cp -rf "/usr/src/${PLUGIN_NAME}/" "${PLUGIN_DIR}/" &&
        rm -rf "${PLUGIN_DIR}/docker/" && \
        echo >&2 "Done! Plugin installed successfully to '${PLUGIN_DIR}'"
fi

exec "$@"
