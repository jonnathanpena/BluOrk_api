package controllers

import (
	"net/http"
	"fmt"
)

func GetAllUsers(w http.ResponseWriter, r *http.Request) {
	fmt.Printf("imprime usuarios")
}