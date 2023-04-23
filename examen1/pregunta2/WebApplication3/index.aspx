﻿<%@ Page Title="" Language="C#" MasterPageFile="~/home.Master" AutoEventWireup="true" CodeBehind="index.aspx.cs" Inherits="WebApplication3.WebForm1" %>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">

    <div class="event-schedule-area-two bg-color pad100">
        <div class="container">


            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Carrera</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Ver Perfil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="inner-box">
                                            <td scope="row">
                                                <div class="event-wrap">
                                                    Informática
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inner-boc">
                                                    Dirección: Edif. de Informática -
                                                    <br>
                                                    Piso 2. Contacto: (2) 261-2255
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <a href="./informatica.aspx">Informática</a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="inner-box">
                                            <td scope="row">
                                                <div class="event-wrap">
                                                    Química
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inner-boc">
                                                    DIRECCIÓN, Calle 27 y Andrés Bello s/n Cota Cota.
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <a href="./quimica.aspx">Química</a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="inner-box">
                                            <td scope="row">
                                                <div class="event-wrap">
                                                    Física 
                                                </div>
                                            </td>
                                            <td>
                                                <div class="inner-boc">
                                                    Dirección, c. 27 Cota-Cota, Campus Universitario.
                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <a href="./fisica.aspx">Física </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</asp:Content>
