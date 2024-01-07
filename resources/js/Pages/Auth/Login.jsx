import { useState, useRef } from "react";
import api from "@/api";
import React from "react";
import { Button, Checkbox, Label, TextInput } from "flowbite-react";
import GeneralLayout from "@/layouts/general";

export default function login() {
    const [isLoading, setIsLoading] = useState(false);

    const emailRef = useRef();
    const passwordRef = useRef();

    const handleLogin = async () => {
        setIsLoading(true);

        const credentials = {
            email: emailRef.current.value,
            password: passwordRef.current.value,
        };

        console.log(credentials);

        try {
            const loginRequest = await api.post("/postLogin", credentials);
            const loginResponse = loginRequest.data;

            if (loginResponse.status === true) {
                console.log(loginResponse);
                // alert(loginResponse.message);

                window.location.href = "/admin";
            }

            if (loginResponse.message === "Unauthorized") {
                console.log("Wrong email or password");
                alert("Wrong email or password");
            }

            var message = "";
            if (loginResponse.message === "Invalid") {
                for (const [key, value] of Object.entries(
                    loginResponse.errors
                )) {
                    console.log(`${key}: ${value}`);
                    message += key + ": " + value + "\n";
                }
                alert(message);
            }
        } catch (error) {
            console.log(error);
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="flex max-w-xl w-full flex-col gap-4">
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="email1" value="Your email" />
                    </div>
                    <TextInput
                        id="email1"
                        type="email"
                        name="email"
                        placeholder="name@email.com"
                        ref={emailRef}
                        // required
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="password1" value="Your password" />
                    </div>
                    <TextInput
                        id="password1"
                        type="password"
                        name="password"
                        placeholder="********"
                        ref={passwordRef}
                        // required
                    />
                </div>
                <div className="flex items-center gap-2">
                    <Checkbox id="remember" />
                    <Label htmlFor="remember">Remember me</Label>
                </div>
                <Button onClick={() => handleLogin()}>Login</Button>
            </div>
        </GeneralLayout>
    );
}
