import { useState, useRef } from "react";
import api from "@/api";
import React from "react";
import { Button, Checkbox, Label, TextInput } from "flowbite-react";
import GeneralLayout from "@/layouts/general";

export default function register() {
    const [isLoading, setIsLoading] = useState(false);

    const nameRef = useRef();
    const emailRef = useRef();
    const passwordRef = useRef();
    const confirmRef = useRef();
    const phoneRef = useRef();

    const handleRegister = async () => {
        setIsLoading(true);

        const credentials = {
            name: nameRef.current.value,
            email: emailRef.current.value,
            password: passwordRef.current.value,
            password_confirmation: confirmRef.current.value,
            phone: phoneRef.current.value,
        };

        console.log(credentials);

        try {
            const registerRequest = await api.post(
                "/postRegister",
                credentials
            );
            const registerResponse = registerRequest.data;

            if (registerResponse.status === true) {
                console.log(registerResponse.message);
                alert("Register success");

                window.location.href = "/login";
            }

            if (registerResponse.message === "Invalid") {
                var message = "";
                for (const [key, value] of Object.entries(
                    registerResponse.errors
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
                        <Label htmlFor="name" value="Your Name" />
                    </div>
                    <TextInput
                        id="name"
                        type="text"
                        placeholder="aaa bbb"
                        ref={nameRef}
                        // required
                        shadow
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="email2" value="Your email" />
                    </div>
                    <TextInput
                        id="email2"
                        type="email"
                        placeholder="name@email.com"
                        ref={emailRef}
                        // required
                        shadow
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="phone" value="Phone Number" />
                    </div>
                    <TextInput
                        id="phone"
                        type="tel"
                        placeholder="081234567890"
                        ref={phoneRef}
                        // required
                        shadow
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="password2" value="Your password" />
                    </div>
                    <TextInput
                        id="password2"
                        type="password"
                        placeholder="********"
                        ref={passwordRef}
                        // required
                        shadow
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label
                            htmlFor="repeat-password"
                            value="Repeat password"
                        />
                    </div>
                    <TextInput
                        id="repeat-password"
                        type="password"
                        placeholder="********"
                        ref={confirmRef}
                        // required
                        shadow
                    />
                </div>
                <div className="flex items-center gap-2">
                    <Checkbox id="agree" />
                    <Label htmlFor="agree" className="flex">
                        I agree with the&nbsp;
                        <a
                            href="#"
                            className="text-cyan-600 hover:underline dark:text-cyan-500"
                        >
                            terms and conditions
                        </a>
                    </Label>
                </div>
                <Button onClick={() => handleRegister()}>
                    Register new account
                </Button>
            </div>
        </GeneralLayout>
    );
}
