FROM jenkins/jenkins:lts

USER root

RUN apt-get update && \
    apt-get install -y docker-cli && \
    groupadd -f docker && \
    usermod -aG docker jenkins

USER jenkins
