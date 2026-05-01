pipeline {
    agent any

    parameters {
        choice(
            name: 'TARGET_VM',
            choices: ['vm1@192.168.2.45'],
            description: 'Select target VM for deployment'
        )
    }

    environment {
        DOCKER_IMAGE = "mcakmak123/erp-immobilien-php"
        DOCKER_TAG = "${BUILD_NUMBER}"
        VM_HOST = "${params.TARGET_VM}"
        APP_DIR = "/home/vm1/erp-immobilien-system"
        SSH_CREDENTIALS = "vm1-ssh-key"
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
                echo "Source code successfully pulled from GitHub"
            }
        }

        stage('Build Image') {
            steps {
                sh '''
                    docker build \
                        --target production \
                        -f docker/php/Dockerfile \
                        -t ${DOCKER_IMAGE}:${DOCKER_TAG} \
                        -t ${DOCKER_IMAGE}:latest \
                        .
                    echo "Docker image built successfully"
                '''
            }
        }

        stage('Push Image') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'dockerhub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh '''
                        echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
                        docker push ${DOCKER_IMAGE}:${DOCKER_TAG}
                        docker push ${DOCKER_IMAGE}:latest
                        echo "Docker image pushed to DockerHub"
                    '''
                }
            }
        }

        stage('Deploy') {
            steps {
                sshagent(credentials: [env.SSH_CREDENTIALS]) {
                    sh '''
                        ssh -o StrictHostKeyChecking=no ${VM_HOST} "
                            cd ${APP_DIR} &&
                            docker compose -f docker-compose.prod.yml pull &&
                            docker compose -f docker-compose.prod.yml up -d &&
                            echo 'Deployment completed successfully'
                        "
                    '''
                }
            }
        }
    }

    post {
        success {
            echo "Build #${BUILD_NUMBER} successfully deployed to ${VM_HOST}"
        }
        failure {
            echo "Pipeline failed on build #${BUILD_NUMBER}"
        }
    }
}
