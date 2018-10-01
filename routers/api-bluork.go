package routers

import (
	"../controllers"
	"github.com/gorilla/mux"
)

func setApiBluOrkRouters(router *mux.Router) *mux.Router {
	router.HandleFunc("/users", controllers.GetAllUsers).Methods("GET")
	return router
}