package routers

import (
	"../controllers"
	"github.com/gorilla/mux"
)

func setApiBluOrkRouters(router *mux.Router) *mux.Router {
	router.http.HandleFunc("/users", controllers.getAllUsers).Method("GET")
	return router
}